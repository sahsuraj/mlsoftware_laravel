<?php
namespace App\Http\Controllers;
//namespace App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use App\SmsTemplate;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\SmsRequest;
use App\Http\Requests\Admin\UpdateSmstemplateRequest;

class SmstemplateController extends Controller
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
		$setData = SmsTemplate::where('id','!=','')
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
                    SmsTemplate::where(['id'=>$box])->update(['status'=>1]);	
				}
				return redirect('/admin/smstemplates')->with('flash_message_success','Sms Template has been activated.');
			}elseif($inactive=='Inactive'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    SmsTemplate::where(['id'=>$box])->update(['status'=>0]);	
				}
				return redirect('/admin/smstemplates')->with('flash_message_error','Sms Templae has been Inactivated.');
			}elseif($delete=='Delete'){
              $count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    $deluser = SmsTemplate::where('id', '=', $box)->first();
					if(!empty($deluser)){
						$deluser->delete();
					}
				}
				return redirect('/admin/smstemplates')->with('flash_message_error','Sms Template has been Deleted.');

			} 
		   }
			
		}	
        
        return view('admin.smstemplates.index')->with(compact('setData'));
    }
	
	 /**
     * create the application sms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
		 return view('admin.smstemplates.add');
	}
	
	/**
     * add the application sms page data.
     *
     * @return \Illuminate\Http\Response
     */
	 public function store(SmsRequest $request)
    {
		if($request->isMethod('post')){
    		$data = $request->all();
			$smspage = new SmsTemplate; 
    		$smspage->slug = $data['slug'];
			$smspage->phone_from = $data['phone_from'];
			$smspage->from_name=$data['from_name'];
			$smspage->content = $data['content'];
			if(empty($data['status'])){
                $smspage->status='0';
            }else{
                $smspage->status='1';
            }
			$smspage->save();
			if($smspage){
		     return redirect('/admin/smstemplates')->with('flash_message_success','Page created Successfully!');
			}else{
			 return back()->withErrors('flash_message_error','Page failed to be created');
			}
		}
		
		
	}	
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id=null)
    {
			
		 // Get sms Details start //
		 $tempDetails = SmsTemplate::where(['id'=>$id])->first();
		 return view('admin.smstemplates.edit')->with(compact('id','tempDetails'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function update(SmsRequest $request, $id=null)
		{
			if($request->isMethod('post')){
				$data = $request->all();
				if(empty($data['status'])){
					$status='0';
				}else{
					$status='1';
				}
				
			 SmsTemplate::where(['id'=>$id])->update(['status'=>$status,'slug'=>$data['slug'],'phone_from'=>$data['phone_from'],'from_name'=>$data['from_name'],'content'=>$data['content']]);
				 return redirect('/admin/smstemplates')->with('flash_message_success','Sms Template data updated Successfully!');
			
			}
		}
	/**
     * Show the sms template delete
     *
     * @return \Illuminate\Http\Response
     */
	
	 public function delete(Request $request, $id=null){
    	$data = SmsTemplate::where('id', '=', $id)->first();
    	if(!empty($data)){
    		$data->delete();
    	}

    	return redirect('/admin/smstemplates')->with('flash_message_success','Sms deleted Successfully!');
    }	
   
}

