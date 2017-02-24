@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Active Clients
@stop

@section('content_body')
	<div class="row">
		
		
		<div class="col-lg-12">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">All Active Clients</h3>
				</div>
				<div class="block-content">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Total Referrals</th>
							<th class="text-center" style="width: 100px;">Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach($actives as $key => $active)
							<tr>
								<td class="text-center">{{++$key}}</td>
								<td>{{$active->client}}</td>
								<td>{{$active->email}} </td>
								<td>{{$active->phone}} </td>
								<td>{{$active->getReferral->count()}} </td>
								<td class="text-center">
									<div class="btn-group">
										<a class="btn btn-xs btn-default" data-toggle="tooltip"
										   title="Block Client" href='{{url("admin/client/$active->id/block")}}'><i
													class="fa fa-ban"></i></a>
										<a href='{{url("admin/client/$active->id/suspend")}}' class="btn btn-xs btn-danger"
										   type="button" data-toggle="tooltip"
										   title="Suspend Client"><i class="fa fa-times"></i></a>
										<a href='{{url("admin/client/$active->id/enter")}}' class="btn btn-xs btn-danger"
										   type="button" data-toggle="tooltip"
										   title="Enter Client Account"><i class="fa fa-times"></i></a>
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
