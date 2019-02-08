@extends('layouts.adminLayout.admin_design')
@section('content')

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/members/index/') }}">Member</a> <a href="#" class="current">View Products</a> </div>
    <h1>Member</h1>
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
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Member</h5>
          </div>
          <div class="widget-content nopadding">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>User ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              	
                <tr class="gradeX">
                  <td class="center">{{ $user->id }}</td>
                  <td class="center">{{ $user->name }}</td>
                  <td class="center">{{ $user->username }}</td>
                  <td class="center">{{ $user->email }}</td>
                  <td class="center">
                    @if(!empty($user->profile_image))
                    <img src="{{ asset('/images/backend_images/member/small/'.$user->profile_image) }}" style="width:50px;">
                    @endif
                  </td>
                  <td class="center">
                    <a href="#myModal{{ $user->id }}" data-toggle="modal" class="btn btn-success btn-mini">View</a> 
                    <a href="{{ url('/admin/edit-product/'.$user->id) }}" class="btn btn-primary btn-mini">Edit</a> 
                    <a href="{{ url('/admin/add-attributes/'.$user->id) }}" class="btn btn-success btn-mini">Add</a>
                    <a href="{{ url('/admin/add-images/'.$user->id) }}" class="btn btn-info btn-mini">Add</a>
                    <a id="delProduct" rel="{{ $user->id }}" rel1="delete-product" href="javascript:"  class="btn btn-danger btn-mini deleteRecord">Delete</a>
 
                        <div id="myModal{{ $user->id }}" class="modal hide">
                          <div class="modal-header">
                            <button data-dismiss="modal" class="close" type="button">×</button>
                            <h3>{{ $user->name }} Full Details</h3>
                          </div>
                          <div class="modal-body">
                            <p>Product ID: {{ $user->id }}</p>
                            <p>Category ID: {{ $user->name }}</p>
                            <p>Product Code: {{ $user->name }}</p>
                            <p>Product Color: {{ $user->name }}</p>
                            <p>Price: {{ $user->id }}</p>
                            <p>Fabric: </p>
                            <p>Pattern: </p>
                            
                          </div>
                        </div>

                  </td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection