@extends('layouts.client')

@section('dashboard')
	DASHBOARD
@stop
@section('title')
	{{env('APP_NAME')}} DASHBOARD
@stop

@section('content')
	<div class="col-lg-12">
		<div class="col-lg-9">
			<div class="content bg-gray-lighter">
				<div class="row">
					<div class="col-lg-6">
						<!-- Material (floating) Lock -->
						<div class="block block-themed">
							<div class="block-header bg-danger">
								<ul class="block-options">
									
									<li>
										<button type="button" data-toggle="block-option"
										        data-action="content_toggle"></button>
									</li>
								</ul>
								<h3 class="block-title">Provide Help</h3>
							</div>
							<div class="block-content">
								<div class="text-center push-10-t push-30">
									<img class="img-avatar-thumb" src="{{asset('assets/img/flag.png')}}"
									     alt="{{env('APP_NAME')}}">
								</div>
								{!! Form::open(array('url' => 'dashboard/provide_help','role'=>'form','class'=>'form-horizontal push-10')) !!}
								<div class="form-group">
									<div class="col-xs-12">
										<div class="form-material form-material-success">
											{!!  Form::text('provideHelp',null,['class'=>"form-control"]) !!}
											@if ($errors->has('provideHelp'))
												<span class="help-inline">
                                            <strong>{{ $errors->first('provideHelp') }}</strong>
                                        </span>
											@endif
											<label for="lock3-password">Amount</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<button class="btn btn-sm btn-danger" type="submit"><i
													class="fa fa-gift push-5-r"></i> Provide Help Now
										</button>
									</div>
								</div>
								{{Form::close()}}
							</div>
						</div>
						<!-- END Material (floating) Lock -->
					</div>
					<div class="col-lg-6">
						<!-- Material (floating) Lock -->
						<div class="block block-themed">
							<div class="block-header bg-danger">
								<ul class="block-options">
									<li>
										<button type="button" data-toggle="block-option"
										        data-action="content_toggle"></button>
									</li>
								</ul>
								<h3 class="block-title">Get Help</h3>
							</div>
							<div class="block-content">
								<div class="text-center push-10-t push-30">
									<img class="img-avatar-thumb" src="{{asset('assets/img/flag.png')}}"
									     alt="{{env('APP_NAME')}}">
								</div>
								{!! Form::open(array('url' => 'dashboard/get_help','role'=>'form','class'=>'form-horizontal push-10')) !!}
								<div class="form-group">
									<div class="col-xs-12">
										<div class="form-material form-material-success">
											
											{!!  Form::text('getHelp',null,['class'=>"form-control"]) !!}
											@if ($errors->has('getHelp'))
												<span class="help-inline">
                            <strong>{{ $errors->first('getHelp') }}</strong>
                        </span>
											@endif
											<label for="lock3-password">Amount</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<button class="btn btn-sm btn-success" type="submit">
											<i class="fa fa-gift push-5-r"></i> Get Help Now
										</button>
									</div>
								</div>
								{{Form::close()}}
							</div>
						</div>
						<!-- END Material (floating) Lock -->
					</div>
				</div>
				
				<div class="row">
					<div class="col-lg-6">
						<div class="block">
							<div class="block-header">
								<h3 class="block-title text-center">Last Provide Help</h3>
							</div>
							<div class="block-content">
								<table class="table table-hover table-borderless">
									<tbody>
									@foreach($provides as $key=> $provide)
										<tr>
											<td class="text-center">{{++$key}}</td>
											<td>{{$provide->user->client->first_name}} {{$provide->user->client->last_name}}</td>
										
											<td class="">
												<span class="label label-success">{{env("CURRENCY_SYMBOL")." ".number_format($provide->amount,2)}}</span>
											</td>
											<td class="text-center">
												{{\Carbon\Carbon::parse($provide->created_at)->diffForHumans()}}
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="block">
							<div class="block-header">
								<h3 class="block-title text-center">Last Get Help</h3>
							</div>
							<div class="block-content">
								<table class="table table-hover table-borderless">
									<tbody>
									@foreach($gets as $key=> $get)
										<tr>
											<td class="text-center">{{++$key}}</td>
											<td>{{$get->user->client->first_name}} {{$get->user->client->last_name}}</td>
										
											<td class="">
												<span class="label label-warning">{{env("CURRENCY_SYMBOL")." ".number_format($get->amount,2)}}</span>
											</td>
											<td class="text-center">
												{{\Carbon\Carbon::parse($get->created_at)->diffForHumans()}}
											</td>
										</tr>
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="content bg-gray-lighter">
				<div class="row">
					<div class="block">
						<div class="block-header">
							<h2 class="block-title text-center">Latest Updates</h2>
						</div>
						<div class="block-content">
							<div class="col-sm-12">
								Coming Soon
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

@stop