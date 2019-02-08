<?php
namespace App\Http\Controllers;
//namespace App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use App\User;
use App\Role;
use Image;
use Config;
use App\EmailTemplate;
use Mail;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UpdateProfileRequest;

class AdminController extends Controller
{
	
	/** 
     * admin login 
     *
     * @return \Illuminate\Http\Response
     */
   public function login(Request $request){
       if($request->isMethod('post')){
		   
           $data=$request->input();
           if(Auth::attempt(['username'=>$data['username'],'password'=>$data['password'],'status'=>'1','admin'=>'1']) || Auth::attempt(['username'=>$data['username'],'password'=>$data['password'],'admin'=>'2','status'=>'1'])){ 
            //Session::put('adminSession',$data['email']);
            return redirect('admin/dashboard');
              //return redirect::action('AdminController@dashboard');
           }else{
            return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
           }
       }
	   return view('admin.admin_login');
   }
/**
     * admin dashboard
     *
     * @return \Illuminate\Http\Response
     */
   public function dashboard(){
    /*if(Session::has('adminSession')){

    }else{
    return redirect('/admin')->with('flash_message_error','Please login to access');
    }*/
      return view('admin.dashboard');
   }

   public function chkPassword(Request $request){
    $data = $request->all();
    $current_password = $data['current_pwd'];
    $check_password = User::where(['admin'=>'1'])->first();
    if(Hash::check($current_password,$check_password->password)){
        echo "true"; die;
    }else {
        echo "false"; die;
    }
}
/**
     * admin update password post update
     *
     * @return \Illuminate\Http\Response
     */
public function updatePassword(Request $request){
    if($request->isMethod('post')){
        $data = $request->all();
        $check_password = User::where(['email' => Auth::user()->email])->first();
        $current_password = $data['current_pwd'];
        if(Hash::check($current_password,$check_password->password)){
            $password = bcrypt($data['new_pwd']);
            User::where('id',Auth::user()->id)->update(['password'=>$password]);
            return redirect('/admin/change_password')->with('flash_message_success','Password updated Successfully!');
        }else {
            return redirect('/admin/change_password')->with('flash_message_error','Incorrect Current Password!');
        }
    }
}
/**
     * admin logOut
     *
     * @return \Illuminate\Http\Response
     */
   public function logout(){
    Session::flush();
    return redirect('/admin')->with('flash_message_success','Logged Out Successfully');
 }

 /**
     * admin change password view
     *
     * @return \Illuminate\Http\Response
     */
 public function change_password(){
    return view('admin.change_password');
 }
 
 /**
     * udate admin profile
     *
     * @return \Illuminate\Http\Response
     */
    public function profile(Request $request,$id=null)
    {
		 $roles =  DB::table('roles')
                   ->where('id','!=','')
				   ->orderBy('name', 'asc')
				    ->get();
		 $userDetails = User::where(['id'=>Auth::user()->id])->first();
		 return view('admin.profile')->with(compact('id','userDetails','roles'));
	}
	
	/**
     * admin my profile update 
     *
     * @return \Illuminate\Http\Response
     */
	 public function updateProfile(UpdateProfileRequest $request, $id=null)
		{
		if($request->isMethod('post')){
			$data = $request->all(); 
		// Upload Image
            if($request->hasFile('image')){
            	$image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/images/backend_images/member/large'.'/'.$fileName;
                    $medium_image_path = 'public/images/backend_images/member/medium'.'/'.$fileName;  
                    $small_image_path = 'public/images/backend_images/member/small'.'/'.$fileName;  
                    $micro_image_path = 'public/images/backend_images/member/micro'.'/'.$fileName;  
	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
     				Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                    Image::make($image_tmp)->resize(165, 165)->save($micro_image_path);
                }
            }else if(!empty($data['current_image'])){
            	$fileName = $data['current_image'];
            }else{
            	$fileName = '';
            }
		 User::where(['id'=>$id])->update(['firstname'=>$data['firstname'],'lastname'=>$data['lastname'],'username'=>$data['username'],
		'profile_image'=>$fileName]);
		     return redirect('/admin/profile')->with('flash_message_success','Admin Profile updated Successfully!');
		
		}
		}
		
	/**
     * admin password recover function
     *
     * @return \Illuminate\Http\Response
     */
		
     public function recover(Request $request){
	
       if($request->isMethod('post')){
         $request->validate([
            'email' => 'required|string|email',
        ]);
        $user=User::where('email', '=', $request->email)->whereIn( 'admin', [1, 2])->first();
		$toUser=$request->email;
		$newPass = trim($this->generateRandomPassword());	
		$password = bcrypt($newPass);
		$fromAdminEmail=Config::get('constants.adminFromEmail');
			if(!empty($user)){
			//email template used	
			$temp = EmailTemplate::where(['id'=>'1'])->first();
			$subject=$temp->subject;
			$hostname = env("APP_URL");
			$link=$hostname;
			$link = '<a href="'.$link.'">Click Here</a>';
			$temp->description = str_replace("{LINK}",$link,$temp->description);
			$temp->description = str_replace("{PASSWORD}",$newPass,$temp->description);
			$data = $temp->description;
			$data = array('data'=>$data);	
			User::where('id',$user->id)->update(['password'=>$password]);	
			Mail::send('email.name', $data, function($message) use($toUser, $subject, $fromAdminEmail) { 
			$message->to($toUser)
			->subject($subject);
			$message->from('info@lifeinbalancecareers.com.au','Jarmila Dolezal');
			});
			return redirect('/admin')->with('flash_message_success','Password successfully sent in your email.');
			}else{
				return redirect('/admin/recover')->with('flash_message_error','User email not exist!');
			}
       }
	   return view('admin/recover');
   }
   	/**
     * forget random password generate
     *
     * @return \Illuminate\Http\Response
     */
   public function generateRandomPassword($length = 6) {
        $password = "";
        $possible = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*(){}/?,><";
        $i = 0;
        while ($i < $length) {
            $char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
            if (!strstr($password, $char)) {
                $password .= $char;
                $i++;
            }
        }
        return $password;
    }
   
}

