@extends('layouts.adminLayout.admin_design')
@section('content')
<style>

div.dt-buttons {
    float: left;
    margin-bottom: 6px;
    margin-left: 12px;
    margin-top: 8px;
    position: relative;
}

</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
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
			
			
			
			</span>
			
          </div>
		

          <div class="widget-content nopadding export_content">
		     
            <table class="table table-bordered table-striped with-check  datatable" id="member_export">
              <thead>
                <tr>
				<th >Username</th>
				<th >Firstname</th>
				<th >Lastname</th>
				<th>Email</th>
				<th>Sponser Email</th>
				<th>Address</th>
				<th>City</th>
				<th>Phone</th>
				<th>Zip</th>
				<th>Country</th>
				<th>UserType</th>
				<th>Registered</th>
                </tr>
              </thead>
              <tbody>
			  
			  @foreach($users as $user)
                <tr class="gradeX">
				
				<td class="center">{{ $user['username'] }}</td>
				<td class="center">{{ $user['firstname'] }}</td>
				<td class="center">{{ $user['lastname'] }}</td>
				<td class="center">{{ $user['email'] }}</td>
				<td class="center">{{ $user['referral_name'] }}</td>
				<td class="center">{{ $user['address'] }}</td>
				<td class="center">{{ $user['city'] }}</td>
				<td class="center">{{ $user['phone'] }}</td>
				<td class="center">{{ $user['zip'] }}</td>
				<td class="center">{{ $user['country']['name'] }}</td>
				<td class="center">{{ $user['role']['display_name'] }}</td>
				<td class="center">{{ date('Y-m-d h:i:s',strtotime($user['created_at'])) }}</td>
               
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