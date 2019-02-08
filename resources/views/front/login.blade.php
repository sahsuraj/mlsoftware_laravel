@extends('layouts.app')

@section('content')

	<section id="front-login-content" class="content">

		<div class="container">

			<div class="row">

				<form class="col-sm-8 col-sm-offset-2 form-horizontal" method="POST" action="{{ route('front.logging') }}">

					{{ csrf_field() }}

					

					<div class="form-group">

						<label class="col-sm-2 control-label" for="email">* Email</label>

						<div class="col-sm-10">

							<input type="email" name="email" id="email" class="form-control" required="required" />

						</div><!--.col-->

					</div><!--.form-group-->



					<div class="form-group">

						<label class="col-sm-2 control-label" for="password">* Password</label>

						<div class="col-sm-10">

							<input type="password" name="password" id="password" class="form-control" required="required" />

						</div><!--.col-->

					</div><!--.form-group-->



					<div class="form-group">

						<div class="col-sm-4 col-sm-offset-2">

							<div class="checkbox">

								<label>

									<input type="checkbox" name="remember" id="remember" value="yes" /> Remember Me

								</label>

							</div><!--.checkbox-->

						</div><!--.col-->



						<div class="col-sm-6 text-right">

							<input type="submit" name="submit" id="submit" class="btn btn-dark" value="Login" />

						</div><!--.col-->

					</div><!--.form-group-->



					<p><a href="{{ route('front.forgot') }}">Forgot Password?</a></p>

				</form><!--.col-->

			</div><!--.row-->

		</div><!--.container-->

	</section><!--#front-login-content-->

@endsection