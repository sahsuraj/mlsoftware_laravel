@extends('templates.front')

@section('title', '404')

@section('content')
	{{--@include('front.submenu')--}}

	@include('messages')

	<section id="front-contact-content">
		<div class="container">
			<div class="row">
				<div class="col-sm-8 col-sm-offset-2 text-center">
					<h1 title="{{ $error }}">404 Error. Page Not Found</h1>
					<p><img src="{{ asset('img/error/flattire.png') }}" alt="Woops..." width="" height="" class="img-responsive" /></p>
				</div><!--.col-->
			</div><!--.row-->
		</div><!--.container-->
	</section><!--#front-contact-content-->
@endsection