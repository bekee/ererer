@extends('layouts.email')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">Reset Password</div>
					<div class="panel-body">
						@if (session('status'))
							<div class="alert alert-success">
								{{ session('status') }}
							</div>
						@endif
						
						<form class="form-horizontal js-validation-login form-horizontal push-30-t" role="form"
						      method="POST" action="{{ url('/password/email') }}">
							{{ csrf_field() }}
							
							<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
								<label for="email" class="col-md-4 control-label">E-Mail Address</label>
								
								<div class="col-md-6">
									<div class="form-material form-material-primary floating">
										<input id="email" type="email" class="form-control" name="email"
										       value="{{ old('email') }}" required>
									</div>
									@if ($errors->has('email'))
										<span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
									@endif
								</div>
							</div>
							
							<div class="form-group">
								<div class="col-md-6 col-md-offset-4">
									<div class="form-group push-30-t">
										<button type="submit" class="btn btn-primary">
											Send Password Reset Link
										</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection


@section('header')
	Password Reset
@stop


@section('title')
	PayMe Password Reset
@stop

@section('first_message')
	Reset My Password
@stop