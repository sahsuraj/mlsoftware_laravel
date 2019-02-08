@extends('layouts.adminLayout.admin_design')
@section('content')
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Banners Listing</a> </div>
    <h1>Banners Listing</h1>
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
    <div class="row-fluid">  <form  class="form-horizontal"  enctype="multipart/form-data" method="post" action="{{ url('admin/banners') }}" name="index" id="memberindex" novalidate="novalidate"> 
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
			<a href="{{ url('/admin/banners/add/') }}" class="btn btn-mini btn-info top_div pull-right" style="margin-right:8px;" title="Add Sms Page">+ Add</a>
			</span>
			
          </div>
		 
          <div class="widget-content nopadding">
		     
            <table class="table table-bordered table-striped with-check data-table" id="example">
              <thead>
                <tr>
				 <th><input type="checkbox" id="title-table-checkbox" name="title-table-checkbox" onClick="toggle(this)" /></th>
                  <th >Name</th>
                  <th width="40%">Site Meta Description</th>
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
                  <td class="center">{!! $data['name'] !!}</td>
                  <td class="center">{!! str_limit($data['meta_description'],200) !!}</td>
                  <td class="center">
				  <?php if($data['status']=='1'){?>
				  <span class="date badge badge-info">Active</span>
				
				  <?php }else{?>
				   <span class="date badge badge-warning">InActive</span>
				  <?php }?></td>
				
				 <td class="center">
						
											    <a type="button" class="btn btn-success btn-mini" title="Edit" href="{{ url('/admin/banners/edit/'.$data['id']) }}"><i class="fa icon-edit"></i></a>
												  <a type="button" data-toggle="modal" class="btn btn-info btn-mini" title="View" href="#myModal{{ $data['id'] }}"><i class="icon-eye-open"></i></a>
												  <a type="button" class="btn btn-danger btn-mini" title="Edit" href="{{ url('/admin/banners/delete/'.$data['id']) }}"><i class="fa icon-remove" onclick="return confirm('Are you sure, you want to delete it?')"></i></a>
                    
							
									 <div id="myModal{{ $data['id'] }}" class="modal hide">
									  <div class="modal-header">
										<button data-dismiss="modal" class="close" type="button">&times;</button>
										<h3>Full Details</h3>
									  </div>
									  <div class="modal-body">
										<p>Banner ID: {{ $data['id'] }}</p>
										<p>Name: {!! $data['name']!!}</p>
										<p>Site Meta Description : {!! $data['meta_description'] !!}</p>
										<p>Banner Image: @if(!empty($data['image_name']))
                    <img src="{{ asset('/images/backend_images/banner/thumb/'.$data['image_name']) }}" style="width:50px;"></br><a href="{{ asset('/images/backend_images/banner/large/'.$data['image_name']) }}" target="_blank" style="color:blue;text-decoration:underline;">Image Link</a>
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