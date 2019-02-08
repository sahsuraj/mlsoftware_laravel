<?php
namespace App\Http\Controllers;
//namespace App\Http\Controllers\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Session;
use App\Setting;
use Image;
use Config;
use Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\Admin\UpdateGeneralSettingRequest;

class SettingController extends Controller
{
	
	
 /**
     * udate admin profile
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$id=null)
    {
		 $dataDetails = Setting::where(['id'=>1])->first();
		 return view('admin.settings.index')->with(compact('id','dataDetails'));
	}
	
	/**
     * admin my profile update 
     *
     * @return \Illuminate\Http\Response
     */
	 public function updateSite(UpdateGeneralSettingRequest $request, $id=null)
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
                    $large_image_path = 'public/images/backend_images/site_logo/large'.'/'.$fileName;
                    $medium_image_path = 'public/images/backend_images/site_logo/medium'.'/'.$fileName;  
                    $small_image_path = 'public/images/backend_images/site_logo/small'.'/'.$fileName;  
                    $micro_image_path = 'public/images/backend_images/site_logo/micro'.'/'.$fileName;  
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
		 Setting::where(['id'=>$id])->update(['site_name'=>$data['site_name'],'site_url'=>$data['site_url'],'admin_from_email'=>$data['admin_from_email'],'admin_email'=>$data['admin_email'],'meta_title'=>$data['meta_title'],'meta_keyword'=>$data['meta_keyword'],'meta_description'=>$data['meta_description'],'referral_link'=>$data['referral_link'],'google_analytics'=>$data['google_analytics'],'footer_content'=>$data['footer_content'],'company_address'=>$data['company_address'],'site_title'=>$data['site_title'],'logo_image'=>$fileName]);
		     return redirect('/admin/generalsetting')->with('flash_message_success','General Setting updated Successfully!');
		
		}
		}
		
	/**
     * delete member image
     *
     * @return \Illuminate\Http\Response
     */
	 public function deleteSettingLogo($id=null){

		// Get member Image
		$memberImage = Setting::where('id',$id)->first();

		// Get member Image Paths
		$large_image_path = 'public/images/backend_images/site_logo/large/';
		$medium_image_path = 'public/images/backend_images/site_logo/medium/';
		$small_image_path = 'public/images/backend_images/site_logo/small/';
		$micro_image_path = 'public/images/backend_images/site_logo/micro/';


		// Delete Large Image if not exists in Folder
        if(file_exists($large_image_path.$memberImage->logo_image)){
            unlink($large_image_path.$memberImage->logo_image);
        }

        // Delete Medium Image if not exists in Folder
        if(file_exists($medium_image_path.$memberImage->logo_image)){
            unlink($medium_image_path.$memberImage->logo_image);
        }

        // Delete Small Image if not exists in Folder
        if(file_exists($small_image_path.$memberImage->logo_image)){
            unlink($small_image_path.$memberImage->logo_image);
        }
		// Delete micro Image if not exists in Folder
        if(file_exists($micro_image_path.$memberImage->logo_image)){
            unlink($micro_image_path.$memberImage->logo_image);
        }

        // Delete Image from Products table
        Setting::where(['id'=>$id])->update(['logo_image'=>'']);

        return redirect()->back()->with('flash_message_success', 'Logo has been deleted successfully');
	}
		
	
}

