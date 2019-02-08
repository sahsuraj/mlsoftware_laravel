<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>	<li><a href="{{ route('front.login') }}">Log In</a></li>
        <div class="flex-center position-ref full-height">
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



					<p><a href="">Forgot Password?</a></p>

				</form><!--.col-->

			</div><!--.row-->

		</div><!--.container-->

	</section><!--#front-login-content-->

        </div>
    </body>
</html>
