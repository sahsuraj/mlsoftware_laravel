@extends('layouts.adminLayout.admin_design')
@section('content')
<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-wysihtml5.css') }}" />
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="{{ url('/admin/dashboard/') }}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="{{ url('/admin/newsletter') }}">News Letter </a> </div>
    <h1>Send News Letter </h1>
	
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
            <h5>Edit Cms Page</h5>
          </div>
          <div class="widget-content nopadding">
            <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('admin/newsletters/send/') }}" name="add_user" id="add_user" novalidate="novalidate">{{ csrf_field() }}
  </br>
			 <div class="widget-title"></span>
            <h5> Details</h5>
          </div> 
			 <div class="control-group">
                <label class="control-label">Select Member <em class="state-error">*</em></label>
                <div class="controls">
                <select class="form-control" placeholder="Click Here to choose members" name="member_id[]" multiple style="width:500px;" >
				<option >Select</option>
				@foreach($users as $users)
				  <option value="{{$users->id}}" {{ old('member_id') == $users->id ? 'selected="selected"' : '' }}>{{$users->firstname.' '.$users->lastname.' |'.$users->email}}</option>
				@endforeach
			  </select>
			  @if ($errors->has('member_id'))
                      <span class="cus_error">{{ $errors->first('member_id') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Mail Subject <em class="state-error">*</em></label>
                <div class="controls">
                  <input type="text" name="subject" id="slug" placeholder="Subject"  style="width:500px;">
				  @if ($errors->has('subject'))
                      <span class="cus_error">{{ $errors->first('subject') }}</span>
				  @endif
                </div>
              </div>
			   <div class="control-group">
                <label class="control-label">Message<em class="state-error">*</em></label>
				
                <div class="controls">
                <?php $message='<table border="0" style="width:100%">
	<tbody>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;
			<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:650px">
				<tbody>
					<tr>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td style="height:60px; text-align:left; vertical-align:top">
						<p><img alt="AutoTrader" src="http://dunagiritourandtravel.com/mlmsoftware/public/images/backend_images/logo.png" style="height:80px; width:200px" /></p>
						</td>
						<td>&nbsp;</td>
					</tr>
					<tr>
						<td>
						<table border="0">
							<tbody>
								<tr>
									<td>&nbsp;</td>
									<td>
									<table align="center" border="0" style="width:323px">
										<tbody>
											<tr>
												<td><strong>News Letter</strong></td>
											</tr>
										</tbody>
									</table>
									</td>
									<td>&nbsp;</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
					<tr>
						<td>
						<table border="0" style="width:640px">
							<tbody>
								<tr>
									<td style="text-align:center; vertical-align:top">&nbsp;</td>
									<td style="vertical-align:top">
									<p>&nbsp;</p>

									<p>The lifeinbalancecareers Team&nbsp;</p>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>
			</td>
			<td>&nbsp;</td>
		</tr>
	</tbody>
</table>
';?>
                 <textarea class="form-control" id="summary-ckeditor" rows="10" name="message" cols="4" style="width:500px;"><?php echo $message;?></textarea>
				 @if ($errors->has('message'))
                      <span class="cus_error">{{ $errors->first('message') }}</span>
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
