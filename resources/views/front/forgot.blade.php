@extends('templates.front')

@section('title', 'Forgot Password')

@section('content')
	{{--@include('front.submenu')--}}

	@include('messages')

	<section id="front-forgot-content" class="content">
		<div class="container">
			<div class="row">
				<form class="col-sm-8 col-sm-offset-2 form-horizontal" method="POST" action="{{ route('front.forgot.submit') }}">
					{{ csrf_field() }}

					
					
					<div class="form-group">
						<label class="col-sm-2 control-label" for="email">* Email</label>
						<div class="col-sm-10">
							<input type="email" name="email" id="email" class="form-control" required="required" />
							<div class="help-block">
								<p>Please enter your email address, and we'll send you an email that gives you a link to change your email.</p>
							</div><!--.help-block-->
						</div><!--.col-->
					</div><!--.form-group-->

					<p class="text-center">
						<input type="submit" class="btn-dark btn" name="forgot-submit" id="forgot-submit" value="Submit" />
					</p><!--.text-->
				</form><!--.col-->
			</div><!--.row-->
		</div><!--.container-->
	</section><!--#front-forgot-content-->
@endsection