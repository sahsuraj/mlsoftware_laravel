@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Sms Template Listing</a> </div>
    <h1>Sms Template Listing</h1>
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
    <div class="row-fluid">  <form  class="form-horizontal"  enctype="multipart/form-data" method="post" action="{{ url('admin/smstemplates') }}" name="index" id="memberindex" novalidate="novalidate"> 
        <div class="span12">
         <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
		
         <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <!--<h5>Member Listing</h5>-->
			<span class="allcp-form">
			<button type="submit" class="btn btn-mini btn-info top_div" title="Active User"  value="Active" name="Active">Active</button>
			<button type="submit" class="btn btn-mini btn-warning top_div"  title="Inactive User" value="Inactive" name="Inactive">Inactive</button>
			</span>
			<span >
			<a href="{{ url('/admin/smstemplates/add/') }}" class="btn btn-mini btn-info top_div pull-right" style="margin-right:8px;" title="Add Sms Page">+ Add</a>
			</span>
			
          </div>
		 
          <div class="widget-content nopadding">
		     
            <table class="table table-bordered table-striped with-check data-table" id="example">
              <thead>
                <tr>
				 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" onClick="toggle(this)" /></th>
                  <th >Slug</th>
                  <th>From No</th>
				  <th>From Name</th>
				  <th>Content</th>
				   <th>Status</th>
				  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  
			  @foreach($setData as $data)
                <tr class="gradeX">
				<td>
				<input type="checkbox" value="{{ $data['id'] }}" class="checkbox_align select-checkbox" name="box1[]"  >
				</td>
                  <td class="center">{{ $data['slug'] }}</td>
                  <td class="center">{{ $data['phone_from'] }}</td>
				   <td class="center">{{ $data['from_name'] }}</td>
				    <td class="center">{{ $data['content'] }}</td>
                  <td class="center">
				  <?php if($data['status']=='1'){?>
				  <span class="date badge badge-info">Active</span>
				
				  <?php }else{?>
				   <span class="date badge badge-warning">InActive</span>
				  <?php }?></td>
				
				 <td class="center">
						
											    <a type="button" class="btn btn-success btn-mini" title="Edit" href="{{ url('/admin/smstemplates/edit/'.$data['id']) }}"><i class="fa icon-edit"></i></a>
												  <a type="button" data-toggle="modal" class="btn btn-info btn-mini" title="View" href="#myModal{{ $data['id'] }}"><i class="icon-eye-open"></i></a>
												  <a type="button" class="btn btn-danger btn-mini" title="Edit" href="{{ url('/admin/smstemplates/delete/'.$data['id']) }}"><i class="fa icon-remove" onclick="return confirm('Are you sure, you want to delete it?')"></i></a>
                    
							
									 <div id="myModal{{ $data['id'] }}" class="modal hide">
									  <div class="modal-header">
										<button data-dismiss="modal" class="close" type="button">&times;</button>
										<h3>Full Details</h3>
									  </div>
									  <div class="modal-body">
										<p>Sms Template ID: {{ $data['id'] }}</p>
										<p>Slug: {{ $data['slug'] }}</p>
										<p>From no : {{ $data['phone_from'] }}</p>
										<p>From name : {{ $data['from_name'] }}</p>
										<p>Content : {!! $data['content'] !!}</p>
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