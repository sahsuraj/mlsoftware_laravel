@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/members/index/') }}">Members</a> <a href="#" class="current">Change Password</a> </div>
    <h1>Change Password</h1>
    @if(Session::has('flash_message_error'))
        <div class="alert alert-error alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_error') !!}</strong>
        </div>
    @endif   
    @if(Session::has('flash_message_success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('flash_message_success') !!}</strong>
        </div>
    @endif       
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
              <h5>Update Password</h5>
            </div>
            <div class="widget-content nopadding">
              <form class="form-horizontal" method="post" action="{{ url('/admin/members/update-password/'.$id) }}" name="password_validate" id="password_validate" novalidate="novalidate">{{ csrf_field() }}
                
                <div class="control-group">
                  <label class="control-label">New Password <em class="state-error">*</em></label>
                  <div class="controls">
                    <input type="password" name="new_pwd" id="new_pwd" />
					@if ($errors->has('new_pwd'))
                      <span class="cus_error">{{ $errors->first('new_pwd') }}</span>
				  @endif
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm Password <em class="state-error">*</em></label>
                  <div class="controls">
                    <input type="password" name="confirm_pwd" id="confirm_pwd" />
					@if ($errors->has('confirm_pwd'))
                      <span class="cus_error">{{ $errors->first('confirm_pwd') }}</span>
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
</div>
@endsection