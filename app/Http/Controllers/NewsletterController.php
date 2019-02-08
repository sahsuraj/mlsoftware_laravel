<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use App\User;
use App\Newsletter;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\NewsRequest;

class NewsletterController extends Controller
{
	
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     /**
     * Show the newsletter send
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		 $users =  DB::table('users')
                   ->where('role_id','!=','1')
				   ->orderBy('firstname', 'asc')
				    ->get();
        return view('admin.newsletters.index')->with(compact('setData','users'));
    }
	
	 
	/**
     * add the application sms page data.
     *
     * @return \Illuminate\Http\Response
     */
	 public function send(NewsRequest $request)
    {
		if($request->isMethod('post')){
    		$data = $request->all();
			$newsletter = new Newsletter; 
    		$newsletter->member_id = json_encode($data['member_id']);
			$newsletter->subject = $data['subject'];
			$newsletter->message=$data['message'];
			//$newsletter->save();
			//sent email to member
		if(!empty($data['member_id'])){
			$subjectdata=$data['subject'];
			foreach($data['member_id'] as $userdata){
				$userData = User::where(['id'=>$userdata])->first();
				$fromAdminEmail=Config::get('constants.adminFromEmail');
				$toUser=$userData->email;
				$hostname = env("APP_URL");
				$data = $data['message'];
				$data = array('data'=>$data);	
				Mail::send('email.name', $data, function($message) use($toUser, $subjectdata, $fromAdminEmail) { 
				$message->to($toUser)
				->subject($subjectdata);
				$message->from('info@lifeinbalancecareers.com.au','Jarmila Dolezal');
				});
			
			}
		}
			//$temp = User::where(['id'=>'1'])->first();
			//$toUser=
			//$subject=$data['subject'];
			//$hostname = env("APP_URL");
			//$temp->description = $message;
			//$data = $temp->description;
			//$data = array('data'=>$data);		
			/*Mail::send('email.name', $data, function($message) use($toUser, $subject, $fromAdminEmail) { 
			$message->to($toUser)
			->subject($subject);
			$message->from('info@lifeinbalancecareers.com.au','Jarmila Dolezal');
			});*/
		    
			if($newsletter){
		     return redirect('/admin/newsletters')->with('flash_message_success','News Letter sent Successfully!');
			}else{
			 return back()->withErrors('flash_message_error','News Letter failed to be send');
			}
		}
	}	
   
}

