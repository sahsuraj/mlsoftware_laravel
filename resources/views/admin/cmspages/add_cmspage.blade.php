@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/cmspages') }}">Cms Pages</a> <a href="#" class="current">Add Cms Page</a> </div>
    <h1>Cms Page</h1>
	
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
            <h5>Add Cms Page</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/cmspages/add-cmspage') }}" name="add_user" id="add_user" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5> Details</h5>
          </div> 
			
			
              <div class="control-group">
                <label class="control-label">Title <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="title" id="title" placeholder="Title"  style="width:500px;">
				  @if ($errors->has('title'))
                      <span class="cus_error">{{ $errors->first('title') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Slug <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="slug" id="slug" placeholder="Slug"  style="width:500px;">
				  @if ($errors->has('slug'))
                      <span class="cus_error">{{ $errors->first('slug') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Page Name <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="page_name" id="page_name" placeholder="Subject"  style="width:500px;">
				  @if ($errors->has('page_name'))
                      <span class="cus_error">{{ $errors->first('page_name') }}</span>
				  @endif
                </div>
              </div>
               <div class="control-group">
                <label class="control-label">Keywords<em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="keywords" id="keywords" placeholder="Subject" style="width:500px;">
				  @if ($errors->has('keywords'))
                      <span class="cus_error">{{ $errors->first('keywords') }}</span>
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
			   <div class="control-group">
                <label class="control-label">Description</label>
				
                <div class="controls">
             
                 <textarea class="form-control" id="summary-ckeditor" rows="10" name="description" cols="10"></textarea>
				 @if ($errors->has('description'))
                      <span class="cus_error">{{ $errors->first('description') }}</span>
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