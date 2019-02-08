<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use Image;
use App\User;
use App\Role;
use App\Country;
use App\ReferralUser;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\KodeInfo\JOrgChart;

class MemberController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(JOrgChart $JOrgChart)
    {
        $this->middleware('auth');
		$this->JOrgChart = $JOrgChart;
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$users = User::where('admin','!=','1')
				->where(function($q) {
				 $q->where('id','!=',Auth::user()->id);
				  // ->orWhere('type', 'public');
			 })
		         ->orderBy('id', 'desc')
		         ->with('role','country')->get()->toArray();/*DB::table('users')
                   ->where('admin','!=','1')
				   ->orderBy('id', 'desc')
				    ->get()->toArray();*/
		if($request->isMethod('post')){
			
    	   $data = $request->all();
		   if(!empty($data['box1'])){
			   if(!empty($data['Active'])){
				   $active = $data['Active'];
			   }else{
				   $active = '';
			   }
			 if(!empty($data['Inactive'])){
				   $inactive =  $data['Inactive'];
			   }else{
				   $inactive = '';
			   }
			  if(!empty($data['Delete'])){
				   $delete =  $data['Delete'];
			   }else{
				   $delete = '';
			   }  
			  if($active== 'Active'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){ 
					$box = $data['box1'][$i] ;
                    User::where(['id'=>$box])->update(['status'=>1]);	
				}
				return redirect('/admin/members/index')->with('flash_message_success','User has been activated.');
			}elseif($inactive=='Inactive'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    User::where(['id'=>$box])->update(['status'=>0]);	
				}
				return redirect('/admin/members/index')->with('flash_message_error','User has been Inactivated.');
			}elseif($delete=='Delete'){
              $count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    $deluser = User::where('id', '=', $box)->first();
					if(!empty($deluser)){
						$deluser->delete();
					}
				}
				return redirect('/admin/members/index')->with('flash_message_error','User has been Deleted.');

			} 
		   }
			
		}			
        
        return view('admin.members.index')->with(compact('users'));
    }
	
	 
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_member(Request $request)
    {
		 $roles =  DB::table('roles')
                   ->where('id','!=','1')
				   ->orderBy('name', 'asc')
				    ->get();//Role::get(); 
		$countries =  DB::table('countries')
				   ->orderBy('name', 'asc')
				    ->get();			
		 return view('admin.members.add_member')->with(compact('roles','countries'));
	}
	
	/**
     * create the application user.
     *
     * @return \Illuminate\Http\Response
     */
	 public function store(UserRequest $request)
    {
		$role_id = Role::where('id', $request->role_id)->first(); 
		if($request->isMethod('post')){
    		$data = $request->all();
			$user = new User; 
    		$user->firstname = $data['firstname'];
			$user->lastname = $data['lastname'];
			$user->referral_name=$data['referral_name'];
			$user->email = $data['email'];
    		$user->username = $data['username'];
			$user->gender = $data['gender'];
			$user->address = $data['address'];
			$user->city = $data['city'];
			$user->phone = $data['phone'];
			$user->zip = $data['zip'];
			$user->country_id = $data['country_id'];
			if(empty($data['status'])){
                $user->status='0';
            }else{
                $user->status='1';
            }
    		$user->is_permission = $data['role_id'];
    		$user->admin = $data['role_id'];
			$user->user_type = $role_id->name;
			$user->role_id = $data['role_id'];
			$user->password = bcrypt($data['password']);//echo "<pre>";print_r($user);die;
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

     				$user->profile_image = $fileName; 

                }
            }
			$user->save();
			$lastInsertiD=$user->id;
			if($user){
				//save referral user //ReferralUser
				$referral = new ReferralUser; 
				$refUserDetails = User::where(['email'=>$data['referral_name']])->first();
				$referral->user_id =$lastInsertiD;
				$referral->reff_user_id =$refUserDetails->id;
				$referral->save();
				
		     return redirect('/admin/members/index')->with('flash_message_success','Member created Successfully!');
			}else{
				   return back()->withErrors('flash_message_error','User failed to be created');
			}
		}
		/*$user = User::create([

    		'email' => $request->email,

    		'password' => bcrypt($request->password),

    		'name' => $request->name,

    		'username' => $request->username,

    		'status' => $request->status,
			
			'is_permission' => $request->role_id,
			
			'admin' => $request->role_id,
			
			'role_id' => $request->role_id,
			
			'user_type' => $role_id->name

    	]);*/
		
	}
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit_member(Request $request,$id=null)
    {
		
		 $roles =DB::table('roles')
                   ->where('id','!=','1')
				   ->orderBy('name', 'asc')
				    ->get(); 
		$countries =  DB::table('countries')
				   ->orderBy('name', 'asc')
				    ->get();			
		 // Get Product Details start //
		 $userDetails = User::where(['id'=>$id])->first();
		 return view('admin.members.edit_member')->with(compact('id','userDetails','roles','countries'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function update(UpdateUserRequest $request, $id=null)
		{
		if($request->isMethod('post')){
			$data = $request->all();
			if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
			$role_id = Role::where('id', $data['role_id'])->first(); 
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
		 User::where(['id'=>$id])->update(['status'=>$status,'firstname'=>$data['firstname'],'lastname'=>$data['lastname'],'username'=>$data['username'],
		'email'=>$data['email'],'role_id'=>$data['role_id'],'is_permission'=>$data['role_id'],'admin'=>$data['role_id'],'user_type'=>$role_id->name,'gender'=>$data['gender'],'city'=>$data['city'],'address'=>$data['address'],'phone'=>$data['phone'],'zip'=>$data['zip'],'country_id'=>$data['country_id'],'profile_image'=>$fileName]);
		     return redirect('/admin/members/index')->with('flash_message_success','Member data updated Successfully!');
		
		}
		}
		
		/**
     * delete member image
     *
     * @return \Illuminate\Http\Response
     */
	 public function deleteMemberImage($id=null){

		// Get member Image
		$memberImage = User::where('id',$id)->first();

		// Get member Image Paths
		$large_image_path = 'public/images/backend_images/member/large/';
		$medium_image_path = 'public/images/backend_images/member/medium/';
		$small_image_path = 'public/images/backend_images/member/small/';

		// Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$memberImage->profile_image)){
            unlink($large_image_path.$memberImage->profile_image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$memberImage->profile_image)){
            unlink($medium_image_path.$memberImage->profile_image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$memberImage->profile_image)){
            unlink($small_image_path.$memberImage->profile_image);
        }

        // Delete Image from Products table
        User::where(['id'=>$id])->update(['profile_image'=>'']);

        return redirect()->back()->with('flash_message_success', 'User image has been deleted successfully');
	}
	
	/**
     * Show the member delete
     *
     * @return \Illuminate\Http\Response
     */
	
	 public function deleteMember(Request $request, $id=null){
    	$user = User::where('id', '=', $id)->first();
    	if(!empty($user)){
    		$user->delete();
    	}

    	return redirect('/admin/members/index')->with('flash_message_success','Member deleted Successfully!');
    }
	
/**
     * admin members changea password
     *
     * @return \Illuminate\Http\Response
     */
	 public function change_password(Request $request,$id=null){
      	return view('admin.members.change_password')->with(compact('id'));
	 }	 
	/**
     * admin members changea password
     *
     * @return \Illuminate\Http\Response
     */
	 public function updateMpassword(Request $request,$id=null){
       if($request->isMethod('post')){
       $data = $request->all();
		 request()->validate([
				
				'new_pwd' => 'required|min:6',                
				'confirm_pwd' => 'required|min:6|max:20|same:new_pwd',

			], [
				'new_pwd.required' => 'Password is required',
				'confirm_pwd.required' => 'Confirm Password is required',
				'new_pwd.min' => 'Password must be at least 6 characters.',
				'confirm_pwd.min' => 'Confirm Password must be at least 6 characters.',
			]);
		//update password
		
		if(!empty($data) && $data['new_pwd']==$data['confirm_pwd']){
			$password = bcrypt($data['new_pwd']);
		    User::where('id',$id)->update(['password'=>$password]);
			return redirect('/admin/members/index')->with('flash_message_success','Member password changed Successfully!');
		}else{
		  return redirect('admin.members.change_password')->with(compact('id'),'flash_message_success','Somthing Wrong!');	
		}
		//return back()->withErrors('flash_message_error','User failed to be created');
	/*	$userPass->id=$id;
		$userPass->password = bcrypt($data['password']);

        if($userPass->save()){
			return view('admin.members.index')->with('flash_message_success','Member password Successfully!');;
		}else{
			return view('admin.members.change_password')->with(compact('id'))->with('flash_message_success','Somthing Wrong!');
		}*/
        //User::where(['id'=>$id])->update(['password'=>bcrypt($data['password'])]);		
	  }
	 }
     
    	 /**
     * udate admin viewGenealogy
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGenealogy(Request $request,$id=null)
    {
		 return view('admin.members.view_genealogy')->with(compact('id'));
	}

 /**
     * udate admin viewGenealogy
     *
     * @return \Illuminate\Http\Response
     */
    public function viewGenview(Request $request,$id=null)
    {
		 $userDetails = User::where(['id'=>$id])->first();
         $response = $this->JOrgChart->getChart($id);
		 $tree=$response['tree_string'];
		 return view('admin.members.view_genview')->with(compact('id','userDetails','tree'));
	}		
}
