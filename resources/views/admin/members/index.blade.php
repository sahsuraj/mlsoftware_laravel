@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Member Listing</a> </div>
    <h1>Member Listing</h1>
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
    <div class="row-fluid">  <form  class="form-horizontal"  enctype="multipart/form-data" method="post" action="{{ url('admin/members/index') }}" name="index" id="memberindex" novalidate="novalidate"> 
        <div class="span12">
         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
		
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!--<h5>Member Listing</h5>-->
			<span class="allcp-form">
			<button type="submit" class="btn btn-mini btn-info top_div" title="Active User"  value="Active" name="Active">Active</button>
			<button type="submit" class="btn btn-mini btn-warning top_div"  title="Inactive User" value="Inactive" name="Inactive">Inactive</button>
			<button type="submit" class="btn btn-mini btn-danger top_div" title="Bulk Delete" value="Delete" name="Delete" onclick="return confirm('Are you sure, you want to delete it?')">Delete</button>
			</span>
			<span >
			<a href="{{ url('/admin/members/add-member/') }}" class="btn btn-mini btn-info top_div pull-right" style="margin-right:8px;" title="Add Member">+ Add</a>
			</span>
          </div>
		

          <div class="widget-content nopadding export_content">
		     
            <table class="table table-bordered table-striped with-check data-table datatable" id="table3">
              <thead>
                <tr>
				 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" onClick="toggle(this)" /></th>
                  <th >Username</th>
                  <th>Email</th>
				   <th>UserType</th>
                  <th>Registered</th>
                  <th>Status</th>
				 <!-- <th>Image</th>-->
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  
			  @foreach($users as $user)
                <tr class="gradeX">
				<td>
				<input type="checkbox" value="{{ $user['id'] }}" class="checkbox_align select-checkbox" name="box1[]"  >
				</td>
                  <td class="center">{{ $user['username'] }}</td>
                  <td class="center">{{ $user['email'] }}</td>
				  <td class="center">{{ $user['role']['display_name'] }}</td>
                  <td class="center">{{ date('Y-m-d h:i:s',strtotime($user['created_at'])) }}</td>
                  <td class="center">
				  <?php if($user['status']=='1'){?>
				  <span class="date badge badge-info">Active</span>
				
				  <?php }else{?>
				   <span class="date badge badge-warning">InActive</span>
				  <?php }?></td>
				 <!-- <td class="center">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('/images/backend_images/member/small/'.$user->profile_image) }}" style="width:50px;">
                    @endif
                  </td>-->
				 <td class="center">
						<div class="btn-group">
						<button data-toggle="dropdown" class="btn btn-success dropdown-toggle">Action <span class="caret"></span></button>
						<ul class="dropdown-menu">
						<li><a href="{{ url('/admin/members/edit-member/'.$user['id']) }}">Edit</a></li>
						<li><a href="#myModal{{ $user['id'] }}" data-toggle="modal" >View</a> </li>
						<li><a href="{{ url('/admin/members/change-password/'.$user['id']) }}">Change Password</a></li>
						<li class="divider"></li>
						<li><a href="{{ url('/admin/members/delete-member/'.$user['id']) }}" onclick="return confirm('Are you sure, you want to delete it?')">Delete</a></li>
						<li><a href="{{ url('/admin/members/view_genealogy/'.$user['id']) }}"  >View Genealogy</a> </li>
						</ul>
						</div>
									 <div id="myModal{{ $user['id'] }}" class="modal hide">
									  <div class="modal-header">
										<button data-dismiss="modal" class="close" type="button">&times;</button>
										<h3>{{ $user['firstname'] }} Full Details</h3>
									  </div>
									  <div class="modal-body">
										<p>User ID: {{ $user['id'] }}</p>
										<p>First Name: {{ $user['firstname'] }}</p>
										<p>Last Name: {{ $user['lastname'] }}</p>
										<p>Role:{{ $user['role']['display_name'] }}</p>
										<p>Gender: {{ $user['gender'] }}</p>
										<p>Email: {{ $user['email'] }}</p>
										<p>Address: {{ $user['address'] }}</p>
										<p>City: {{ $user['city'] }}</p>
										<p>Zip: {{ $user['zip'] }}</p>
										<p>Phone: {{ $user['phone'] }}</p>
										<p>Country: {{ $user['country']['name'] }}</p>
										<p>Profile Pic: @if(!empty($user['profile_image']))
                    <img src="{{ asset('/images/backend_images/member/small/'.$user['profile_image']) }}" style="width:50px;">
                    @endif</p>
									</div>
									</div>
				  </td>
                </tr>
               @endforeach
              </tbody>
            </table>
			 </form>
          </div>
        </div>
      </div>
   
  </div>
 </div>
</div>


<script>

function toggle(source) {
  checkboxes = document.getElementsByName('box1[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}	
</script>
	
@endsection