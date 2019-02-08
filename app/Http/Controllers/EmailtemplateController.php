<?php
namespace App\Http\Controllers;
//namespace App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use App\EmailTemplate;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UpdateEmailtemplateRequest;

class EmailtemplateController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
		$emailtemp = EmailTemplate::where('id','!=','')
				->orderBy('id', 'asc')->get()->toArray();
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
                    EmailTemplate::where(['id'=>$box])->update(['status'=>1]);	
				}
				return redirect('/admin/emailtemplates')->with('flash_message_success','Email Template has been activated.');
			}elseif($inactive=='Inactive'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    EmailTemplate::where(['id'=>$box])->update(['status'=>0]);	
				}
				return redirect('/admin/emailtemplates')->with('flash_message_error','Email Templae has been Inactivated.');
			}elseif($delete=='Delete'){
              $count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    $deluser = EmailTemplate::where('id', '=', $box)->first();
					if(!empty($deluser)){
						$deluser->delete();
					}
				}
				return redirect('/admin/emailtemplates')->with('flash_message_error','Email Template has been Deleted.');

			} 
		   }
			
		}	
        
        return view('admin.emailtemplates.index')->with(compact('emailtemp'));
    }
	
	 
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id=null)
    {
			
		 // Get Product Details start //
		 $tempDetails = Emailtemplate::where(['id'=>$id])->first();
		 return view('admin.emailtemplates.edit')->with(compact('id','tempDetails'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function update(UpdateEmailtemplateRequest $request, $id=null)
		{
		if($request->isMethod('post')){
			$data = $request->all();
			if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
			
		 Emailtemplate::where(['id'=>$id])->update(['status'=>$status,'title'=>$data['title'],'subject'=>$data['subject'],'description'=>$data['description']]);
		     return redirect('/admin/emailtemplates')->with('flash_message_success','Email Template data updated Successfully!');
		
		}
		}
		
   
}

