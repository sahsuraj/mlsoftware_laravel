@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/members/index/') }}">Members</a> <a href="#" class="current">Edit Member</a> </div>
    <h1>Members</h1>
	 <!--@if (count($errors) > 0)
      <div class="alert alert-danger">

          <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>

    @endif-->
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
            <h5>Edit Member</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/members/edit-member/'.$userDetails->id) }}" name="add_user" id="add_user" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5>Sponsor Details</h5>
          </div> 
			<div class="control-group">
                <label class="control-label">Sponsor Referral Email </label>
                <div class="controls">
                  <input type="text" name="referral_name" id="referral_name" placeholder="wwwuser" value="{{ $userDetails->referral_name }} " disabled>
				  @if ($errors->has('referral_name'))
                      <span class="cus_error">{{ $errors->first('referral_name') }}</span>
				  @endif
                </div>
              </div>
			  <div class="widget-title"> <span class="icon"> <i class="icon-user"></i> </span>
            <h5>Member Details</h5>
          </div>              
			 <div class="control-group">
                <label class="control-label">Role <em class="state-error">*</em></label>
                <div class="controls">
                <select class="form-control" name="role_id" style="width:220px;">
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
                <label class="control-label">First Name <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="firstname" id="firstname" placeholder="First Name" value="{{ $userDetails->firstname }}">
				  @if ($errors->has('firstname'))
                      <span class="cus_error">{{ $errors->first('firstname') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Last Name <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="lastname" id="lastname" placeholder="Last Name" value="{{ $userDetails->lastname }}">
				  @if ($errors->has('lastname'))
                      <span class="cus_error">{{ $errors->first('lastname') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Username <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="username" id="username" value="{{ $userDetails->username }}" >
				  @if ($errors->has('username'))
                      <span class="cus_error">{{ $errors->first('username') }}</span>
				  @endif
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="email" name="email" id="email" value="{{ $userDetails->email }}" >
				  @if ($errors->has('email'))
                      <span class="cus_error">{{ $errors->first('email') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
			  <label class="control-label">Gender <em class="state-error">*</em></label>
                <div class="controls">
                <label>
                  <div class="radio" id="uniform-undefined"><span class="checked">
				  <input name="gender" value="male" style="opacity: 0;" type="radio" {{ $userDetails->gender == 'male' ? 'checked' : ''}}></span></div>
                  Male</label>
                <label>
                  <div class="radio" id="uniform-undefined"><span class="">
				  <input name="gender" value="female" style="opacity: 0;" type="radio" {{ $userDetails->gender == 'female' ? 'checked' : ''}}></span></div>
                  Female</label>
                  @if ($errors->has('gender'))
                      <span class="cus_error">{{ $errors->first('gender') }}</span>
				  @endif
              </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Address <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="address" id="address" placeholder="Address" value="{{ $userDetails->address }}">
				  @if ($errors->has('address'))
                      <span class="cus_error">{{ $errors->first('address') }}</span>
				  @endif
                </div>
              </div>
			    <div class="control-group">
                <label class="control-label">City <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="city" id="city" placeholder="City" value="{{ $userDetails->city }}">
				  @if ($errors->has('city'))
                      <span class="cus_error">{{ $errors->first('city') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Phone <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="phone" id="phone" placeholder="Phone" value="{{ $userDetails->phone }}">
				  @if ($errors->has('phone'))
                      <span class="cus_error">{{ $errors->first('phone') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Zip <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="zip" id="zip" placeholder="Zip" value="{{ $userDetails->zip }}">
				  @if ($errors->has('zip'))
                      <span class="cus_error">{{ $errors->first('zip') }}</span>
				  @endif
                </div>
              </div> 
			   <div class="control-group">
                <label class="control-label">Country <em class="state-error">*</em></label>
                <div class="controls">
                <select class="form-control" name="country_id" style="width:220px;" >
				<option value="">Select</option>
				@foreach($countries as $country)
				  <option value="{{$country->id}}" {{ $userDetails->country_id == $country->id ? 'selected="selected"' : '' }}>{{$country->name}}</option>
				@endforeach
			  </select>
			  @if ($errors->has('country_id'))
                      <span class="cus_error">{{ $errors->first('country_id') }}</span>
				  @endif
                </div>
              </div>
			 <!--<div class="control-group">
                <label class="control-label">Password</label>
                <div class="controls">
                  <input type="password" name="password" id="password" value="{{ old('password') }}">
				  @if ($errors->has('password'))
                      <span class="cus_error">{{ $errors->first('password') }}</span>
				  @endif
                </div>
              </div>
			  <div class="control-group">
                <label class="control-label">Retype Password </label>
                <div class="controls">
                  <input type="password" name="confirm_password" id="confirm_password" value="{{ old('confirm_password') }}">
				  @if ($errors->has('confirm_password'))
                      <span class="cus_error">{{ $errors->first('confirm_password') }}</span>
				  @endif
                </div>
              </div>-->
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
              <div class="control-group">
                <label class="control-label">Enable</label>
                <div class="controls">

                  <input type="checkbox" name="status" id="status"  @if($userDetails->status == "1") checked @endif value="1">
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