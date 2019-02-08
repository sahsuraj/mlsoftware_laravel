@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('jorg-charts/tree.css') }}" />
 <style type="text/css">
   .jOrgChart {
            margin: 10px;
            padding: 20px;
        }

         .jOrgChart .node {
            font-size: 14px;
            background-color: #35363B;
            border-radius: 8px;
            border: 5px solid white;
            color: #F38630;
            -moz-border-radius: 8px;
        }
        .node label {
            font-family: tahoma;
            font-size: 14px;
            line-height: 11px;
            padding-top: 30px;
        }
    </style>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Genealogy</a> </div>
    <h1>View Genealogy</h1>
       
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="row-fluid">
        <div class="span12">
          <div class="widget-box">
           
            <br><br>

				<iframe width="100%" height="700px" src="{{ url('/admin/members/view_genview/'.$id) }}" style="padding-top:5px; margin-top:-80px;  margin-right: 2px;"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection