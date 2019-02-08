@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
<style>
#add_setting input[type=text]{
	width:60%;
	height:30px !important;
}
div#cke_summary-ckeditor {
    width: 631px !important;
}
</style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="javascript:void(0)">Site Setting</a> 
	
    @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button> 
                    <strong>{!! session('flash_message_error') !!}</strong>
            </div>
        @endif   
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">&times;</button> 
                    <strong>{!! session('flash_message_success') !!}</strong>
            </div>
        @endif
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
            <h5>Edit Site Setting</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/site-update/'.$dataDetails->id) }}" name="add_user" id="add_setting" novalidate="novalidate">{{ csrf_field() }}
             
              <div class="control-group">
                <label class="control-label">Site Name<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="site_name" id="site_name" value="{{ $dataDetails->site_name}}">
				  @if ($errors->has('site_name'))
                      <span class="cus_error">{{ $errors->first('site_name') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Site Title<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="site_title" id="site_title" value="{{ $dataDetails->site_title}}">
				  @if ($errors->has('site_title'))
                      <span class="cus_error">{{ $errors->first('site_title') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Site Url<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="site_url" id="site_url" value="{{ $dataDetails->site_url }}">
				  @if ($errors->has('site_url'))
                      <span class="cus_error">{{ $errors->first('site_url') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Admin Mail Id<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="admin_email" id="admin_email" value="{{ $dataDetails->admin_email }}">
				  @if ($errors->has('admin_email'))
                      <span class="cus_error">{{ $errors->first('admin_email') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Admin From Mail<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="admin_from_email" id="admin_from_email" value="{{ $dataDetails->admin_from_email }}">
				  @if ($errors->has('admin_from_email'))
                      <span class="cus_error">{{ $errors->first('admin_from_email') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Site Meta Title<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="meta_title" id="meta_title"  value="{{ $dataDetails->meta_title }}">
				  @if ($errors->has('meta_title'))
                      <span class="cus_error">{{ $errors->first('meta_title') }}</span>
				  @endif
                </div>
              </div>
			 <div class="control-group">
                <label class="control-label">Site Meta Keywords<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="meta_keyword" id="meta_keyword"  value="{{ $dataDetails->meta_keyword }}">
				  @if ($errors->has('meta_keyword'))
                      <span class="cus_error">{{ $errors->first('meta_keyword') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Site Meta Description<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="meta_description" id="meta_description"  value="{{ $dataDetails->meta_description }}">
				  @if ($errors->has('meta_description'))
                      <span class="cus_error">{{ $errors->first('meta_description') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Referral Link Identifier<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="referral_link" id="referral_link"  value="{{ $dataDetails->referral_link }}">
				  @if ($errors->has('referral_link'))
                      <span class="cus_error">{{ $errors->first('referral_link') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Google Analytics<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="google_analytics" id="google_analytics"  value="{{ $dataDetails->google_analytics }}">
				  @if ($errors->has('google_analytics'))
                      <span class="cus_error">{{ $errors->first('google_analytics') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Footer Content<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="footer_content" id="footer_content"  value="{{ $dataDetails->footer_content }}">
				  @if ($errors->has('footer_content'))
                      <span class="cus_error">{{ $errors->first('footer_content') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Company Address<em class="state-error">*</em></label>
				
                <div class="controls">
             
                 <textarea class="form-control" id="summary-ckeditor"  rows="6" name="company_address" cols="5">{{ $dataDetails->company_address }}</textarea>
				 @if ($errors->has('company_address'))
                      <span class="cus_error">{{ $errors->first('company_address') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Site Logo</label>
                <div class="controls">
                  <div id="uniform-undefined">
                    <table>
                      <tr>
                        <td>
                          <input name="image" id="image" type="file">
                          @if(!empty($dataDetails->logo_image ))
                            <input type="hidden" name="current_image" value="{{ $dataDetails->logo_image  }}"> 
                          @endif
                        </td>
                        <td>
                          @if(!empty($dataDetails->logo_image ))
                            <img style="width:30px;" src="{{ asset('/images/backend_images/site_logo/medium/'.$dataDetails->logo_image ) }}"> | <a onclick="return confirm('Are you sure you want to delete this record?');" href="{{ url('/admin/settings/delete-logo-image/'.$dataDetails->id) }}">Delete</a>
                          @endif
                        </td>
                      </tr>
                    </table>
                </div>
              </div>
              </div>
          
              <div class="form-actions">
			  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
			  <input type="submit" value="Submit" class="btn btn-success">
				 
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection