@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/emailtemplates') }}">Email Templates</a> <a href="#" class="current">Edit Email Template</a> </div>
    <h1>Email Template</h1>
	
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
            <h5>Edit Email Template</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/emailtemplates/update/'.$tempDetails->id) }}" name="add_user" id="add_user" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5> Details</h5>
          </div> 
			
			
              <div class="control-group">
                <label class="control-label">Title <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="title" id="title" placeholder="Title" value="{{ $tempDetails->title }}" style="width:500px;">
				  @if ($errors->has('title'))
                      <span class="cus_error">{{ $errors->first('title') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Subject <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="subject" id="subject" placeholder="Subject" value="{{ $tempDetails->subject }}" style="width:500px;">
				  @if ($errors->has('subject'))
                      <span class="cus_error">{{ $errors->first('subject') }}</span>
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
			   <div class="control-group">
                <label class="control-label">Description</label>
				
                <div class="controls">
 <h5 style="color:red;">Don't change the single braces variable { } </h5>
                 <textarea class="form-control" id="summary-ckeditor" rows="10" name="description" cols="10">{{ $tempDetails->description }}</textarea>
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