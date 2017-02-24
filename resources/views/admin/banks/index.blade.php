@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Banks
@stop

@section('content_body')
	<div class="row">
		
		<div class="col-lg-6">
			<!-- Material (floating) Login -->
			<div class="block block-themed">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button type="button" data-toggle="block-option" data-action="content_toggle"></button>
						</li>
					</ul>
					<h3 class="block-title">Add New Bank</h3>
				</div>
				<div class="block-content">
					{!! Form::open(array('url' => 'admin/banks','class'=>'form-horizontal push-10-t push-10')) !!}
						<div class="form-group">
							<div class="col-xs-12">
								<div class="form-material floating">
									<input class="form-control" type="text" id="login3-username" name="bank">
									@if ($errors->has('bank'))
										<span class="help-block">
                                        <strong>{{ $errors->first('bank') }}</strong>
                                    </span>
									@endif
									<label for="login3-username">Bank Name</label>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-xs-12">
								<button class="btn btn-sm btn-primary" type="submit"><i
											class="fa fa-arrow-right push-5-r"></i> Add New
								</button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
			</div>
			<!-- END Material (floating) Login -->
		</div>
		<div class="col-lg-6">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">All Allowed Banks</h3>
				</div>
				<div class="block-content">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Name</th>
							<th class="text-center" style="width: 100px;">Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach($banks as $key => $bank)
							<tr>
								<td class="text-center">{{++$key}}</td>
								<td>{{$bank->name}}</td>
								<td class="text-center">
									<div class="btn-group">
										<a class="btn btn-xs btn-default" data-toggle="tooltip"
										   title="Edit Bank" href='{{url("admin/bank/$bank->id/edit")}}'><i
													class="fa fa-pencil"></i></a>
										<a href='{{url("admin/r_bank/$bank->id")}}' class="btn btn-xs btn-danger"
										   type="button" data-toggle="tooltip"
										   title="Remove Bank"><i class="fa fa-times"></i></a>
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
