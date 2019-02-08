@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/members/index/') }}">My Profile</a> 
	
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
            <h5>Edit My Profile</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/update-profile/'.$userDetails->id) }}" name="add_user" id="add_user" novalidate="novalidate">{{ csrf_field() }}
              <div class="control-group">
                <label class="control-label">Role</label>
                <div class="controls">
                <select class="form-control" name="role_id" disabled style="width:220px;">
				<option value="">Select</option>
				@foreach($roles as $role)
				  <option value="{{$role->id}}" {{ $userDetails->role_id == $role->id ? 'selected="selected"' : '' }} >{{$role->display_name}}</option>
				@endforeach
			  </select>
			  @if ($errors->has('role_id'))
                      <span class="cus_error">{{ $errors->first('role_id') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">First Name</label>
                <div class="controls">
                  <input type="text" name="firstname" id="firstname" value="{{ $userDetails->firstname }}">
				  @if ($errors->has('firstname'))
                      <span class="cus_error">{{ $errors->first('firstname') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Last Name</label>
                <div class="controls">
                  <input type="text" name="lastname" id="lastname" value="{{ $userDetails->lastname }}">
				  @if ($errors->has('lastname'))
                      <span class="cus_error">{{ $errors->first('lastname') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Username</label>
                <div class="controls">
                  <input type="text" name="username" id="username" value="{{ $userDetails->username }}">
				  @if ($errors->has('username'))
                      <span class="cus_error">{{ $errors->first('username') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email</label>
                <div class="controls">
                  <input type="email" name="email" id="email" disabled value="{{ $userDetails->email }}">
				  @if ($errors->has('email'))
                      <span class="cus_error">{{ $errors->first('email') }}</span>
				  @endif
                </div>
              </div>
			
			   <div class="control-group">
                <label class="control-label">Profile Image</label>
                <div class="controls">
                  <div id="uniform-undefined">
                    <table>
                      <tr>
                        <td>
                          <input name="image" id="image" type="file">
                          @if(!empty($userDetails->profile_image))
                            <input type="hidden" name="current_image" value="{{ $userDetails->profile_image }}"> 
                          @endif
                        </td>
                        <td>
                          @if(!empty($userDetails->profile_image))
                            <img style="width:30px;" src="{{ asset('/images/backend_images/member/small/'.$userDetails->profile_image) }}"> | <a href="{{ url('/admin/members/delete-member-image/'.$userDetails->id) }}">Delete</a>
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