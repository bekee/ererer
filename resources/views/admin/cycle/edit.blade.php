@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Cycler Setup
@stop

@section('content_body')
	<div class="row">
		
		<div class="col-lg-12">
			<!-- Material (floating) Login -->
			<div class="block block-themed">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button type="button" data-toggle="block-option" data-action="content_toggle"></button>
						</li>
					</ul>
					<h3 class="block-title">Edit Cycler</h3>
				</div>
				<div class="block-content">
					{!! Form::model($cycler,array('url' => ['admin/cycler',$cycler->id],'method'=>'PATCH','class'=>'form-horizontal push-10-t push-10')) !!}
					<div class="form-group">
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('amount',null,['class'=>'form-control']) !!}
								@if ($errors->has('amount'))
									<span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Amount Range</label>
							</div>
						</div>
						
						
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('percentage',null,['class'=>'form-control']) !!}
								@if ($errors->has('percentage'))
									<span class="help-block">
                                        <strong>{{ $errors->first('percentage') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Percentage Increase</label>
							</div>
						</div>
						
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('days',null,['class'=>'form-control']) !!}
								@if ($errors->has('days'))
									<span class="help-block">
                                        <strong>{{ $errors->first('days') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Days Interval</label>
							</div>
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-xs-12">
							<button class="btn btn-sm btn-primary" type="submit"><i
										class="fa fa-arrow-right push-5-r"></i> Update
							</button>
						</div>
					</div>
					{!! Form::close() !!}
				</div>
			</div>
			<!-- END Material (floating) Login -->
		</div>
		<div class="col-lg-12">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Cyclers</h3>
				</div>
				<div class="block-content">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Amount</th>
							<th>Percentage Increase (%)</th>
							<th>Days</th>
							<th class="text-center" style="width: 100px;">Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach($cyclers as $key => $cycler)
							<tr>
								<td class="text-center">{{++$key}}</td>
								<td>{{$cycler->amount}}</td>
								<td>{{$cycler->percentage}}</td>
								<td>{{$cycler->days}}</td>
								<td class="text-center">
									<div class="btn-group">
										<a class="btn btn-xs btn-default" data-toggle="tooltip"
										   title="Edit Bonus"
										   href='{{url("admin/cycler/$cycler->id/edit")}}'><i
													class="fa fa-pencil"></i></a>
										<a href='{{url("admin/r_cycler/$cycler->id")}}'
										   class="btn btn-xs btn-danger"
										   type="button" data-toggle="tooltip"
										   title="Remove Bonus"><i class="fa fa-times"></i></a>
									</div>
								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- END Hover Table -->
		</div>
	
	</div>
@stop
