<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use App\Cmspage;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\CmsRequest;
use App\Http\Requests\Admin\UpdateCmspagetemplateRequest;

class CmspageController extends Controller
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
		$listData = Cmspage::where('id','!=','')
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
                    Cmspage::where(['id'=>$box])->update(['status'=>1]);	
				}
				return redirect('/admin/cmspages')->with('flash_message_success','Cms Pages has been activated.');
			}elseif($inactive=='Inactive'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    Cmspage::where(['id'=>$box])->update(['status'=>0]);	
				}
				return redirect('/admin/cmspages')->with('flash_message_error','Cms Pages has been Inactivated.');
			}elseif($delete=='Delete'){
              $count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    $deluser = Cmspage::where('id', '=', $box)->first();
					if(!empty($deluser)){
						$deluser->delete();
					}
				}
				return redirect('/admin/cmspages')->with('flash_message_error','Cms Pages has been Deleted.');

			} 
		   }
			
		}	
        
        return view('admin.cmspages.index')->with(compact('listData'));
    }
	
	 
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id=null)
    {
			
		 // Get Product Details start //
		 $tempDetails = Cmspage::where(['id'=>$id])->first();
		 return view('admin.cmspages.edit')->with(compact('id','tempDetails'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function update(UpdateCmspagetemplateRequest $request, $id=null)
		{
		if($request->isMethod('post')){
			$data = $request->all();
			if(empty($data['status'])){
                $status='0';
            }else{
                $status='1';
            }
			
		 Cmspage::where(['id'=>$id])->update(['status'=>$status,'title'=>$data['title'],'page_name'=>$data['page_name'],'keywords'=>$data['keywords'],'description'=>$data['description']]);
		     return redirect('/admin/cmspages')->with('flash_message_success','Cms Pages data updated Successfully!');
		
		}
		}
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_cmspage(Request $request)
    {
		 return view('admin.cmspages.add_cmspage');
	}
	
	/**
     * create the application user.
     *
     * @return \Illuminate\Http\Response
     */
	 public function store(CmsRequest $request)
    {
		if($request->isMethod('post')){
    		$data = $request->all();
			$cmspage = new Cmspage; 
    		$cmspage->title = $data['title'];
			$cmspage->slug = $data['slug'];
			$cmspage->page_name=$data['page_name'];
			$cmspage->keywords = $data['keywords'];
    		$cmspage->description = $data['description'];
			if(empty($data['status'])){
                $cmspage->status='0';
            }else{
                $cmspage->status='1';
            }
			$cmspage->save();
			if($cmspage){
		     return redirect('/admin/cmspages')->with('flash_message_success','Page created Successfully!');
			}else{
			 return back()->withErrors('flash_message_error','Page failed to be created');
			}
		}
		
		
	}	
   
}

