@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
			
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/faqs') }}">Faq Page</a> <a href="#" class="current">Add Faq </a> </div>
    
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
            <h5>Add Faq</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/faqs/add') }}" name="add_sms" id="add_sms" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5> Details</h5>
          </div> 
			
			<div class="control-group">
                <label class="control-label">Question<em class="state-error">*</em></label>
				
                <div class="controls">
 
                 <textarea class="form-control" id="summary-ckeditor" rows="10" name="question" cols="10"></textarea>
				 @if ($errors->has('question'))
                      <span class="cus_error">{{ $errors->first('question') }}</span>
				  @endif
                </div>
              </div>
			<div class="control-group">
                <label class="control-label">Answer<em class="state-error">*</em></label>
				
                <div class="controls">
 
                 <textarea class="form-control" id="summary-ckeditor2" rows="10"  name="answer" cols="10"></textarea>
				 @if ($errors->has('answer'))
                      <span class="cus_error">{{ $errors->first('answer') }}</span>
				  @endif
                </div>
              </div>  
              <div class="control-group">
                <label class="control-label">Language <em class="state-error">*</em></label>
                <div class="controls">
                  <select class="form-control" name="language" placeholder="Click here to choose" style="width:220px;" >
				  <option value=""></option>
				  <option value="en">English</option>
			     </select>
			      @if ($errors->has('language'))
                      <span class="cus_error">{{ $errors->first('language') }}</span>
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