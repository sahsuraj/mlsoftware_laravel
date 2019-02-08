@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/banners') }}">Banners</a> <a href="#" class="current">Edit Banner</a> </div>
    
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
            <h5>Edit Banner</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/banners/update/'.$tempDetails->id) }}" name="add_user" id="add_user" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5> Details</h5>
          </div> 
			
              <div class="control-group">
                <label class="control-label">Name<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="name" id="name" value="{{ $tempDetails->name }}">
				  @if ($errors->has('name'))
                      <span class="cus_error">{{ $errors->first('name') }}</span>
				  @endif
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Banner Image<em class="state-error">*</em></label>
                <div class="controls">
                  <div id="uniform-undefined">
                    <table>
                      <tr>
                        <td>
                          <input name="image" id="image" type="file">
                          @if(!empty($tempDetails->image_name))
                            <input type="hidden" name="current_image" value="{{ $tempDetails->image_name }}"> 
                          @endif
                        </td>
                        <td>
                          @if(!empty($tempDetails->image_name))
                            <img style="width:100px;" src="{{ asset('/images/backend_images/banner/large/'.$tempDetails->image_name) }}">
                          @endif
						  </br><a href="{{ asset('/images/backend_images/banner/large/'.$tempDetails['image_name']) }}" target="_blank" style="color:blue;text-decoration:underline;">Image Link</a>
                        </td>
                      </tr>
                    </table>
                </div>
              </div>
              </div>
			     <div class="control-group">
                <label class="control-label">Site Meta Description<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="meta_description" id="meta_description" value="{{ $tempDetails->meta_description }}">
				  @if ($errors->has('meta_description'))
                      <span class="cus_error">{{ $errors->first('meta_description') }}</span>
				  @endif
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">

                  <input type="checkbox" name="status" id="status"  @if($tempDetails->status == "1") checked @endif value="1">
				  @if ($errors->has('status'))
                      <span class="cus_error">{{ $errors->first('status') }}</span>
				  @endif
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