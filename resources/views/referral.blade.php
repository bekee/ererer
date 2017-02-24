@extends('layouts.login')

@section('title')
	SIGNUP
@stop
@section('login')
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
		<div class="push-30-t push-20 animated fadeIn">
			<!-- Register Title -->
			<div class="text-center">
				<i class="fa fa-2x fa-circle-o-notch text-primary"></i>
				<h1 class="h3 push-10-t">Create Account</h1>
			</div>
			<!-- END Register Title -->
			
			<!-- Register Form -->
			<!-- jQuery Validation (.js-validation-register class is initialized in js/pages/base_pages_register.js) -->
			<!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
			
			{!! Form::open(array('url' => 'signup','class'=>'js-validation-register form-horizontal push-50-t push-50')) !!}
			
			@if (session()->has('flash_notification.message'))
				<div class="alert alert-{{ session('flash_notification.level') }}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{!! session('flash_notification.message') !!}
				</div>
			
			@endif
			@if ($errors->has('ref'))
				<div>
					<span class="help-block">
                        <strong>{{ $errors->first('ref') }}</strong>
                    </span>
				</div>
			
			@endif
			
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						{{Form::hidden('ref',$ref_code)}}
						@if ($errors->has('register-first-name'))
							<span class="help-block">
                                <strong>{{ $errors->first('register-first-name') }}</strong>
                            </span>
						@endif
						{{Form::text('register-first-name',null,['id'=>'register-first-name','class'=>'form-control','placeholder'=>'Please enter first name'])}}
						<label for="register-first-name">First Name</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						@if ($errors->has('register-last-name'))
							<span class="help-block">
                                <strong>{{ $errors->first('register-last-name') }}</strong>
                            </span>
						@endif
						{{Form::text('register-last-name',null,['id'=>'register-last-name','class'=>'form-control','placeholder'=>'Please enter last name'])}}
						<label for="register-last-name">Last Name</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						@if ($errors->has('register-mobile'))
							<span class="help-block">
                                <strong>{{ $errors->first('register-mobile') }}</strong>
                            </span>
						@endif
						{{Form::text('register-mobile',null,['id'=>'register-mobile','class'=>'form-control','placeholder'=>'Please enter mobile number'])}}
						<label for="register-username">Mobile No.</label>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						@if ($errors->has('register-email'))
							<span class="help-block">
                                <strong>{{ $errors->first('register-email') }}</strong>
                            </span>
						@endif
						{{Form::email('register-email',null,['id'=>'register-email','class'=>'form-control','placeholder'=>'Please provide your email'])}}
						<label for="register-email">Email</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						@if ($errors->has('ref_email'))
							<span class="help-block">
                                <strong>{{ $errors->first('ref_email') }}</strong>
                            </span>
						@endif
						{{Form::email('ref_email',$ref_email,['id'=>'register-email','readonly','class'=>'form-control','placeholder'=>'Please provide your email'])}}
						<label for="register-email">Referred By</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						@if ($errors->has('password'))
							<span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
						@endif
						{{Form::password('password',['id'=>'register-password','class'=>'form-control','placeholder'=>'Choose a strong password..'])}}
						<label for="register-password">Password</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-success">
						@if ($errors->has('password_confirmation'))
							<span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>
						@endif
						{{Form::password('password_confirmation',['id'=>'register-password2','class'=>'form-control','placeholder'=>'..and confirm it'])}}
						<label for="register-password2">Confirm Password</label>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-7 col-sm-8">
					<label class="css-input switch switch-sm switch-success">
						@if ($errors->has('register-terms'))
							<span class="help-block">
                                <strong>{{ $errors->first('register-terms') }}</strong>
                            </span>
						@endif
						{{Form::checkbox('register-terms',null,false,['id'=>'register-terms'])}}
						<span></span> I agree with
						terms &amp; conditions
					</label>
				</div>
				<div class="col-xs-5 col-sm-4">
					<div class="font-s13 text-right push-5-t">
						<a href="#" data-toggle="modal" data-target="#modal-terms">View Terms</a>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3">
					<button class="btn btn-sm btn-block btn-success" type="submit">Create Account</button>
				</div>
			</div>
		{{Form::close()}}
		<!-- END Register Form -->
		</div>
	</div>
@stop

@section('extra_js')
	<script src="{{asset('assets/js/pages/base_pages_register.js')}}"></script>
@stop