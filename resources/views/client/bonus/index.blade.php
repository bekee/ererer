@extends('layouts.client')

@section('title')
	{{env('APP_NAME')}} Referral Bonus
@stop
@section('dashboard')
	Referral Bonus
@stop
@section('content')
	<div class="col-lg-12">
		<div class="col-lg-9">
			@if(!empty($first_time_bonus))
				<div class="row">
					
					<div class="col-lg-12">
						<!-- Hover Table -->
						<div class="block">
							<div class="block-header">
								<h3 class="block-title">First Time Bonus</h3>
								<div class="block-options">
									Amount
									:<strong><span>{{env('CURRENCY_SYMBOL')." ".number_format($first_time_bonus->amount_gained,2)}}</span></strong>
									@if($first_time_bonus->provideHelp->status == 'done' || $first_time_bonus->provideHelp->status == 'withdrawn')
										@if($first_time_bonus->status=='pending')
											<a href="{{url("dashboard/first_time/$first_time_bonus->id")}}"
											   class="btn btn-danger">MOVE
												TO WALLET</a>
										@elseif('withdrawn')
											
											<span class="text-center text-success-light">Already Moved to wallet</span>
										@else
											<span class="text-center text-danger">Pending Approval</span>
										@endif
									@else
										<span class="text-center text-danger">Pending Approval</span>
									@endif
								</div>
							</div>
						</div>
						<!-- END Hover Table -->
					</div>
				
				</div>
			@endif
			<div class="row">
				
				<div class="col-lg-12">
					<!-- Hover Table -->
					<div class="block">
						<div class="block-header">
							<h3 class="block-title">Referral Bonuses</h3>
							
							<div class="block-options">
								Current Bonus
								:<strong><span>{{env('CURRENCY_SYMBOL')." ".number_format($referralsBonuses->where('status','approved')->sum('amount'),2)}}</span></strong>
								<a href="{{url("dashboard/move_bonus")}}"
								   class="btn btn-danger">MOVE
									TO WALLET</a>
							</div>
						</div>
						<div class="block-content">
							<table class="table table-hover">
								<thead>
								<tr>
									<th class="text-center" style="width: 50px;">#</th>
									<th>Bonus Amount</th>
									<th>Partner Investment</th>
									
									<th>Bonus Partner</th>
								</tr>
								</thead>
								<tbody>
								@if(empty($referralsBonuses))
									<tr>
										<td class="text-center"></td>
									</tr>
								@endif
								@foreach($referralsBonuses as $key => $referral_bonus)
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
