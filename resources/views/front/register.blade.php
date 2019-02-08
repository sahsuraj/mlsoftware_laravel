@extends('templates.front')



@section('title', 'Register')



@section('content')

	{{--@include('front.submenu')--}}
@include('front.finder.menu')


	@include('messages')



	<section id="front-login-content" class="content">

		<div class="container">

			<div class="row">

				<form class="col-sm-8 col-sm-offset-2" method="POST" action="{{ route('front.store') }}">



					{{ csrf_field() }}



	                <div class="form-group col-xs-12">

	                    <label for="email">Email *</label>

	                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="clearfix visible-xs-block"></div>



	                <div class="form-group col-sm-6">

	                    <label for="password">Password *</label>

	                    <input type="password" name="password" id="password" class="form-control" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-sm-6">

	                    <label for="confirmation">Confirm *</label>

	                    <input type="password" name="password_confirmation" class="form-control" id="confirmation" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-sm-6">

	                    <label for="first_name">First Name *</label>

	                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-sm-6">

	                    <label for="last_name">Last Name *</label>

	                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-xs-12">

	                    <label for="company">Company</label>

	                    <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}" />

	                </div><!--.form-group-->

	                <div class="form-group col-xs-12">

	                    <label for="coupon">Coupon</label>

	                    <input type="text" name="coupon" id="coupon" class="form-control" value="{{ old('coupon') }}" />

	                </div><!--.form-group-->

	                <div class="form-group col-xs-12">

	                    <label for="phone">Phone *</label>

	                    <input type="tel" name="phone" id="phone" class="form-control" value="{{ old('phone') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="clearfix visible-xs-block"></div>



	                <div class="form-group col-sm-9">

	                    <label for="street">Street Address *</label>

	                    <input type="text" name="street" id="street" class="form-control" value="{{ old('street') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-sm-3">

	                    <label for="suite">Suite</label>

	                    <input type="text" name="suite" id="suite" class="form-control" value="{{ old('suite') }}" />

	                </div><!--.form-group-->



	                <div class="form-group col-xs-12">

	                    <label for="country_id">Country *</label>

	                    <select name="country_id" id="country_id" class="form-control" required="required">

	                        <option value="">Select a Country</option>

	                        @foreach($countries as $country)

	                            @if(old('country') == $country->id)

	                                <option value="{{ $country->id }}" selected="selected">{{ $country->name }}</option>

	                            @else

	                                <option value="{{ $country->id }}">{{ $country->name }}</option>

	                            @endif

	                        @endforeach

	                    </select><!--#country-->

	                </div><!--.form-group-->



	                <div class="clearfix visible-xs-block"></div>



	                <div class="form-group col-sm-5">

	                    <label for="city">City *</label>

	                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-sm-4">

	                    <label for="region_id">State/Province *</label>

	                    <select name="region_id" id="region_id" class="form-control" required="required">

	                        <option value="">Select a State or Province</option>

	                        @foreach($regions as $region)

	                            @if(old('region') == $region->id)

	                                <option value="{{ $region->id }}" selected="selected">{{ $region->name }}</option>

	                            @else

	                                <option value="{{ $region->id }}">{{ $region->name }}</option>

	                            @endif

	                        @endforeach

	                    </select><!--#region-->

	                </div><!--.form-group-->



	                <div class="form-group col-sm-3">

	                    <label for="postal">Postal Code *</label>

	                    <input type="text" name="postal" id="postal" class="form-control" value="{{ old('postal') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-xs-12">

	                    <label for="supplier">Supplier *</label>

	                    <input type="text" name="supplier" id="supplier" class="form-control" value="{{ old('supplier') }}" required="required" />

	                </div><!--.form-group-->



	                <div class="form-group col-xs-12">

	                    <div class="help-block">

	                        <p>If you like, you can enter the serial number of your device right away. If not, that is alright, you can register your device in your account page at another time.</p>

	                    </div><!--.help-block-->

	                    <label for="serial">Serial Number</label>

	                    <input type="text" name="serial" id="serial" class="form-control device-mask" value="{{ old('serial') }}" />

	                </div><!--.form-group-->



	                <div class="col-xs-12">

	                    <input type="submit" name="submit" id="submit" class="btn btn-dark" value="Register" />

	                </div><!--.col-->

				</form>

			</div><!--.row-->

		</div><!--.container-->

	</section><!--#front-login-content-->

@endsection