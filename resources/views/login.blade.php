@extends('layouts.login')

@section('title')
	LOGIN
@stop
@section('login')
	<div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
		<div class="push-30-t push-50 animated fadeIn">
			<!-- Login Title -->
			<div class="text-center">
				<i class="fa fa-2x fa-circle-o-notch text-primary"></i>
				<p class="text-muted push-15-t">Get Help When You Need it</p>
			</div>
			<!-- END Login Title -->
			
			<!-- Login Form -->
			<!-- jQuery Validation (.js-validation-login class is initialized in js/pages/base_pages_login.js) -->
			<!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
			{!! Form::open(array('url' => 'login','class'=>'js-validation-login form-horizontal push-30-t')) !!}
			@if (session()->has('flash_notification.message'))
				<div class="alert alert-{{ session('flash_notification.level') }}">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					{!! session('flash_notification.message') !!}
				</div>
			@endif
			
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-primary floating">
						{{Form::email('login-username',null,['id'=>'login-username','class'=>'form-control'])}}
						<label for="login-username">Email</label>
						@if ($errors->has('login-username'))
							<span class="help-inline">
                            <strong>{{ $errors->first('login-username') }}</strong>
                        </span>
						@endif
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					<div class="form-material form-material-primary floating">
						{{Form::password('login-password',['id'=>'login-password','class'=>'form-control'])}}
						<label for="login-password">Password</label>
						@if ($errors->has('login-password'))
							<span class="help-inline">
                            <strong>{{ $errors->first('login-password') }}</strong>
                        </span>
						@endif
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-12">
					{!! app('captcha')->display()!!}
				</div>
			</div>
			<div class="form-group">
				<div class="col-xs-6">
					<label class="css-input switch switch-sm switch-primary">
						{{Form::checkbox('login-remember-me',null,false,['id'=>'login-remember-me'])}}
						<span></span>
						Remember Me?
					</label>
				</div>
				<div class="col-xs-6">
					<div class="font-s13 text-right push-5-t">
						<a href="{{url('password/reset')}}">Forgot Password?</a>
					</div>
				</div>
			</div>
			<div class="form-group push-30-t">
				<div class="col-xs-6 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<button class="btn btn-sm btn-block btn-primary" type="submit">Log in</button>
				</div>
			
			</div>
			<div class="form-group push-30-t">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
					<a class=" btn-sm btn-block text-center" href="{{url('signup')}}" style="display: inline-block">SignUp</a>
				</div>
			
			</div>
		{{Form::close()}}
		<!-- END Login Form -->
		</div>
	</div>
@stop
