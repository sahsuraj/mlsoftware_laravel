<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use Config;
use Image;
use App\Banner;
use Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\BannerRequest;
use App\GlobalSetting\Setting;

class BannerController extends Controller
{

	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct( Setting $Setting)
    {
        $this->middleware('auth');
		$this->Setting = $Setting;
		//for get setting table data
		$globalSetting=$this->Setting->getData();
    }

	
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { 
		$setData = Banner::where('id','!=','')
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
                    Banner::where(['id'=>$box])->update(['status'=>1]);	
				}
				return redirect('/admin/banners')->with('flash_message_success','Banner has been activated.');
			}elseif($inactive=='Inactive'){
				$count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    Banner::where(['id'=>$box])->update(['status'=>0]);	
				}
				return redirect('/admin/banners')->with('flash_message_error','Banner has been Inactivated.');
			}elseif($delete=='Delete'){
              $count = Count($data['box1']);
				for($i=0;$i<$count;$i++){
					$box = $data['box1'][$i] ;
                    $deluser = Banner::where('id', '=', $box)->first();
					if(!empty($deluser)){
						$deluser->delete();
					}
				}
				return redirect('/admin/banners')->with('flash_message_error','Banner has been Deleted.');

			} 
		   }
			
		}	
        
        return view('admin.banners.index')->with(compact('setData'));
    }
	
	 /**
     * create the application sms page.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
		 return view('admin.banners.add');
	}
	
	/**
     * add the application sms page data.
     *
     * @return \Illuminate\Http\Response
     */
	 public function store(BannerRequest $request)
    {
		if($request->isMethod('post')){
    		$data = $request->all();
			$banner = new Banner; 
    		$banner->name = $data['name'];
			$banner->meta_description = $data['meta_description'];
			if(empty($data['status'])){
                $banner->status='0';
            }else{
                $banner->status='1';
            }
			// Upload Image
            if($request->hasFile('image')){
            	$image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
					$imageData=explode('.', $image_tmp->getClientOriginalName());
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = $imageData[0].'_'.rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/images/backend_images/banner/large'.'/'.$fileName;
                    $thumb_image_path = 'public/images/backend_images/banner/thumb'.'/'.$fileName;   

	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($thumb_image_path);

     				$banner->image_name = $fileName; 

                }
            }
			$banner->save();
			if($banner){
		     return redirect('/admin/banners')->with('flash_message_success','Banner created Successfully!');
			}else{
			 return back()->withErrors('flash_message_error','Banner failed to be created');
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
		 $tempDetails = Banner::where(['id'=>$id])->first();
		 return view('admin.banners.edit')->with(compact('id','tempDetails'));
	}
	
	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	 public function update(BannerRequest $request, $id=null)
		{
			if($request->isMethod('post')){
				$data = $request->all();
				if(empty($data['status'])){
					$status='0';
				}else{
					$status='1';
				} 
			// Upload Image
            if($request->hasFile('image')){
            	$image_tmp = Input::file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
					$large_image_path = 'public/images/backend_images/banner/large'.'/'.$data['current_image'];
                    $thumb_image_path = 'public/images/backend_images/banner/thumb'.'/'.$data['current_image']; 				
					// Delete Large Image if not exists in Folder
					if(file_exists($large_image_path)){
						unlink($large_image_path);
						unlink($thumb_image_path);
					}
					$imageData=explode('.', $image_tmp->getClientOriginalName());
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = $imageData[0].'_'.rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/images/backend_images/banner/large'.'/'.$fileName;
                    $thumb_image_path = 'public/images/backend_images/banner/thumb'.'/'.$fileName;   

	                Image::make($image_tmp)->save($large_image_path);
 					Image::make($image_tmp)->resize(600, 600)->save($thumb_image_path);

     				$filename = $fileName; 

                }
            }else{
                $filename=$data['current_image'];
            }			
			 Banner::where(['id'=>$id])->update(['status'=>$status,'name'=>$data['name'],'meta_description'=>$data['meta_description'],'image_name'=>$filename]);
				 return redirect('/admin/banners')->with('flash_message_success','Banner data updated Successfully!');
			
			}
		}
	/**
     * Show the sms template delete
     *
     * @return \Illuminate\Http\Response
     */
	
	 public function delete(Request $request, $id=null){
    	$data = Banner::where('id', '=', $id)->first();
    	if(!empty($data)){
		// Get member Image Paths
		$large_image_path = 'public/images/backend_images/banner/large/';
		$thumb_image_path = 'public/images/backend_images/banner/thumb/';
		// Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$data->image_name)){
            unlink($large_image_path.$data->image_name);
			 unlink($thumb_image_path.$data->image_name);
        }
    		$data->delete();
    	}

    	return redirect('/admin/banners')->with('flash_message_success','Banner deleted Successfully!');
    }	
   
}

