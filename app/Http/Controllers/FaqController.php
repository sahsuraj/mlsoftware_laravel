<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use App\Faq;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\FaqRequest;

class FaqController extends Controller
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
		$setData = Faq::where('id','!=','')
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
                    Faq::where(['id'=>$box])->update(['status'=>1]);	
				}
				return redirect('/admin/faqs')->with('flash_message_success','Faq has been activated.');
			}elseif($inactive=='Inactive'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    Faq::where(['id'=>$box])->update(['status'=>0]);	
				}
				return redirect('/admin/faqs')->with('flash_message_error','Faq has been Inactivated.');
			}elseif($delete=='Delete'){
              $count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    $deluser = Faq::where('id', '=', $box)->first();
					if(!empty($deluser)){
						$deluser->delete();
					}
				}
				return redirect('/admin/faqs')->with('flash_message_error','Faq has been Deleted.');

			} 
		   }
			
		}	
        
        return view('admin.faqs.index')->with(compact('setData'));
    }
	
	 /**
     * create the application sms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
		 return view('admin.faqs.add');
	}
	
	/**
     * add the application sms page data.
     *
     * @return \Illuminate\Http\Response
     */
	 public function store(FaqRequest $request)
    {
		if($request->isMethod('post')){
    		$data = $request->all();
			$faq = new Faq; 
    		$faq->question = $data['question'];
			$faq->answer = $data['answer'];
			$faq->language=$data['language'];
			if(empty($data['status'])){
                $faq->status='0';
            }else{
                $faq->status='1';
            }
			$faq->save();
			if($faq){
		     return redirect('/admin/faqs')->with('flash_message_success','Faq created Successfully!');
			}else{
			 return back()->withErrors('flash_message_error','Faq failed to be created');
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
		 $tempDetails = Faq::where(['id'=>$id])->first();
		 return view('admin.faqs.edit')->with(compact('id','tempDetails'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function update(FaqRequest $request, $id=null)
		{
			if($request->isMethod('post')){
				$data = $request->all();
				if(empty($data['status'])){
					$status='0';
				}else{
					$status='1';
				}
				
			 Faq::where(['id'=>$id])->update(['status'=>$status,'question'=>$data['question'],'answer'=>$data['answer'],'language'=>$data['language']]);
				 return redirect('/admin/faqs')->with('flash_message_success','Faq data updated Successfully!');
			
			}
		}
	/**
     * Show the sms template delete
     *
     * @return \Illuminate\Http\Response
     */
	
	 public function delete(Request $request, $id=null){
    	$data = Faq::where('id', '=', $id)->first();
    	if(!empty($data)){
    		$data->delete();
    	}

    	return redirect('/admin/faqs')->with('flash_message_success','Faq deleted Successfully!');
    }	
   
}

