@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Referral Bonus Setup
@stop

@section('content_body')
	<div class="row">
		
		<div class="col-lg-12">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Referral Bonuses</h3>
				</div>
				<div class="block-content">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Bonus Amount</th>
							
							<th>Bonus Type</th>
							<th class="text-center" style="width: 100px;">Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach($referral_bonuses as $key => $referral_bonus)
							<tr>
								<td class="text-center">{{++$key}}</td>
								<td>{{$referral_bonus->amount}}</td>
								<td>{{$referral_bonus->referral_count}}</td>
								<td>{{$referral_bonus->percentage}}</td>
								<td>{{$referral_bonus->user_type}}</td>
								<td class="text-center">
									<div class="btn-group">
										<a class="btn btn-xs btn-default" data-toggle="tooltip"
										   title="Edit Bonus"
										   href='{{url("admin/first_time_referral_bonuses/$referral_bonus->id/edit")}}'><i
													class="fa fa-pencil"></i></a>
										<a href='{{url("admin/r_first_time_referral_bonuses/$referral_bonus->id")}}'
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
