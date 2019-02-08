<!DOCTYPE html>
<html lang="en">
<head>
        <title>LIFE IN BALANCE CAREERS</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/bootstrap-responsive.min.css') }}" />
        <link rel="stylesheet" href="{{ asset('css/backend_css/matrix-login.css') }}" />
		<link rel="stylesheet" href="{{ asset('css/backend_css/matrix-style.css') }}" />
        <link href="{{ asset('fonts/backend_fonts/font-awesome.css')}}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

</head>
  <body>
        <div id="loginbox">   <br><br><br><br>
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
		
            <form id="loginform" class="form-vertical" method="post" action="{{ url('admin') }}">{!! csrf_field() !!}
				 <div class="control-group normal_text"> <h3><img src="{{ asset('images/backend_images/logo_original.png') }}" alt="Logo" /></h3>
				 <h4 style="color: black;font-size: 17.5px;font-weight: lighter;">Login to Admin</h4>
				 </div>
				 
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                           <input type="text" name="username" class="form-control" placeholder="Username" id="username" />
                        </div>
						@if ($errors->has('username'))
							  <span class="cus_error" style="margin-left:21px;">{{ $errors->first('username') }}</span>
						  @endif
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <input type="password"  class="form-control" name="password" placeholder="Password" id="password"/>
                        </div>
						@if ($errors->has('password'))
							  <span class="cus_error" style="margin-left:21px;">{{ $errors->first('password') }}</span>
						  @endif
                    </div>
                </div>
				 <div class="control-group">
                    <div class="main_input_box">
					<input type="submit" value="Login" style="background-color:#62549a;text-align:center;" class="btn btn-success btn-block" />
					</div>
					</div>
					<div class="text-center help-block">
                        <a href="{{ url('/admin/recover/') }}"><small style="font-size:13px;">Forgot password?</small></a>
                    </div>
				</br>
            </form>
			 <form id="recoverform" class="form-vertical" method="post" action="{{ url('/admin/recover/') }}">{!! csrf_field() !!}
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" name="email" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><input type="submit" value="Recover" class="btn btn-info" /> </span>
                </div>
            </form>
        </div>
        
        <script src="{{ asset('js/backend_js/jquery.min.js') }}"></script>  
        <script src="{{ asset('js/backend_js/bootstrap.min.js') }}"></script> 
        <script src="{{ asset('js/backend_js/matrix.login.js') }}"></script>
		<script src="{{ asset('js/backend_js/jquery.uniform.js') }}"></script> 
		<script src="{{ asset('js/backend_js/select2.min.js') }}"></script> 
		<script src="{{ asset('js/backend_js/jquery.validate.js') }}"></script> 
        <script src="{{ asset('js/backend_js/matrix.form_validation.js') }}"></script>		
    </body>

</html>