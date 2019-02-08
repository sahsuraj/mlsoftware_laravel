@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
			
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/banners') }}">Banners</a> <a href="#" class="current">Add Banner </a> </div>
    
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
            <h5>Add Banner</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/banners/add') }}" name="add_sms" id="add_sms" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5> Details</h5>
          </div> 
			
			
              <div class="control-group">
                <label class="control-label">Name<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="name" id="name" >
				  @if ($errors->has('name'))
                      <span class="cus_error">{{ $errors->first('name') }}</span>
				  @endif
                </div>
              </div>
			    <div class="control-group">
                <label class="control-label">Banner Image<em class="state-error">*</em></label>
                <div class="controls">
                  <div class="uploader" id="uniform-undefined"><input name="image" id="image" type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
                </div>
              </div>
			    <div class="control-group">
                <label class="control-label">Site Meta Description<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="meta_description" id="meta_description" >
				  @if ($errors->has('meta_description'))
                      <span class="cus_error">{{ $errors->first('meta_description') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">

                  <input type="checkbox" name="status" id="status"  >
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