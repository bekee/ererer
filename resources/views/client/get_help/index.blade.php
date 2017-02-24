@extends('layouts.client')
@section('title')
	{{env('APP_NAME')}} Get Help
@stop

@section('dashboard')
	Get Help
@stop
@section('content')
	<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
	<script src="{{asset('assets/js/countdown/jquery.countdown.min.js')}}"></script>
	
	<div class="content bg-gray-lighter">
		<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
		<div class="block">
			<div class="block-header">
				<h3 class="block-title">My Get Help (
					<small>UNMATCHED</small>
					)
				</h3>
			</div>
			<div class="block-content">
				
				<table class="js-table-sections table table-hover">
					<thead>
					<tr>
						<th>#</th>
						<th>GET Amount</th>
						<th>Un-Matched Balance</th>
						<th class="hidden-xs" style="width: 15%;">Date Created</th>
						
						<th style="width: 15%;">Status</th>
					</tr>
					</thead>
					
					@if(($unmatcheds->isEmpty()))
						<tbody class="js-table-sections-header open">
						<tr>
							<td class="text-center" style="width: 15%;" colspan="6">
								You currently do not have any unmatched get help
							</td>
						</tr>
						</tbody>
					@else
					
					@endif
					
					@foreach($unmatcheds as $key => $unmatched)
						
						<tbody class="js-table-sections-header">
						<tr>
							<td >{{++$key}}</td>
							<td class="font-w600">{{env('CURRENCY_SYMBOL').' '.number_format($unmatched->amount,2)}}</td>
							<td class="font-w100 text-amethyst">{{env('CURRENCY_SYMBOL').' '.number_format($unmatched->amount-$unmatched->amount_received,2)}}</td>
							<td class="hidden-xs">
								<em class="text-muted">{{\Carbon\Carbon::parse($unmatched->created_at)->diffForHumans()}}</em>
							
							</td>
							<td>
								
								@if(\Carbon\Carbon::parse($unmatched->expected_match_date)->greaterThan(\Carbon\Carbon::now()))
									<span class="label label-info">
										{{$unmatched->status}}
									</span>
								@else
									<span class="label label-success">
										Ready To be matched
									</span>
								@endif
							
							</td>
						</tr>
						</tbody>
						<tbody></tbody>
					@endforeach
				</table>
			</div>
		</div>
		<!-- END Table Sections -->
	</div>
	
	
	<!--Cancelled-->
	<div class="content bg-gray-lighter">
		<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
		<div class="block">
			<div class="block-header">
				<h3 class="block-title">GET HELP (
					<small>MATCHED LIST</small>
					)
				</h3>
			</div>
			<div class="block-content">
				
				<table class="js-table-sections table table-hover">
					<thead>
					<tr>
						<th style="width: 30px;"></th>
						<th style="width: 30px;">#</th>
						<th>MATCHED Amount</th>
						<th>Partner</th>
						
						
						<th style="width: 15%;">Date Created</th>
						
						<th class="hidden-xs" style="width: 15%;">Time Left</th>
						<th class="hidden-xs" style="width: 15%;">Proof</th>
						<th style="width: 15%;">Status</th>
					</tr>
					</thead>
					@if(empty($matches))
						<tbody class="js-table-sections-header">
						<tr>
							<td class="text-center" colspan="10">
								You currently do not have any cancelled GET HELP
							</td>
						</tr>
						</tbody>
					@endif
					@foreach($matches as $key => $matching)
						<tbody class="js-table-sections-header  {{$key==0 ? 'open' : ''}}">
						<tr>
							<td class="text-center">
								<i class="fa fa-angle-right"></i>
							</td>
							<th style="width: 30px;">{{++$key}}</th>
							<td class="font-w600">{{$matching->amount}}</td>
							<td></td>
							<td>
								<span class="label label-info">Matched</span>
							</td>
							<td class="font-w600">{{$matching->amount_paid}}</td>
							<td>
								<span class="label label-info">See Date</span>
							</td>
							<td></td>
							<td></td>
							<td class="hidden-xs">
							</td>
						</tr>
						</tbody>
						
						<tbody>
						
						@foreach($matching->matchedList as $key2=> $matchMe)
							<tr>
								<th style="width: 30px;"></th>
								<th style="width: 30px;">{{++$key2}}</th>
								
								<td class="font-w600 text-danger">+ {{$matching->amount}}</td>
								
								<td>
									<small>{{$matchMe->provideHelp->user->client->first_name}} {{$matchMe->provideHelp->user->client->last_name}}
										<br/>{{$matchMe->provideHelp->user->phone}}</small>
								</td>
								<td class="font-w600 text-success">+ {{$matching->amount_paid}}</td>
								<td class="hidden-xs">
									<small class="text-muted">
										{{$matchMe->provideHelp->timer->more_time
										?  \Carbon\Carbon::parse($matchMe->provideHelp->timer->date_time_to)->addHour($matchMe->provideHelp->timer->more_time) :
									\Carbon\Carbon::parse($matchMe->provideHelp->timer->date_time_to) }}
									</small>
								</td>
								<td>
									@if(!empty($matchMe->proof))
										<small class="text-muted">Waiting for you to confirm payment</small><br/>
									@else
										<small class="text-muted">Waiting for partner to upload proof of payment</small>
										<small class="text-muted" id="{{$key.$key2}}"></small><br/>
										<a href="{{url('dashboard/add_hour/'.$matching->id)}}"
										   class="btn btn-sm btn-danger">Add 1
											More Hour</a>
									
									@endif
									
									<script>
                                        $("#{{$key.$key2}}").countdown("{{$matchMe->provideHelp->timer->more_time
										?  \Carbon\Carbon::parse($matchMe->provideHelp->timer->date_time_to)->addHour($matchMe->getHelp->timer->more_time) :
									\Carbon\Carbon::parse($matchMe->provideHelp->timer->date_time_to)}}", function (event) {
                                            $(this).html(event.strftime('%D days %H:%M:%S'));
                                        });
									</script>
								</td>
								<td>
									@if(empty($matchMe->proof))
										Waiting for payment proof
									@else
										
										<img src="{{Storage::disk('teller')->url('images/teller/'.$matchMe->proof)}}"
										     height="50px" width="50px">
										
										<a href="{{Storage::disk('teller')->url('images/teller/'.$matchMe->proof)}}">View
											Teller</a><br/>
										<a href="{{url('dashboard/confirm_proof/'.$matchMe->id)}}"
										   class="btn btn-sm btn-info">Confirm
											Payment</a>
									@endif
								</td>
								<td>
									<span class="label label-warning">{{$matchMe->status}}</span>
								</td>
							</tr>
						@endforeach
						</tbody>
					
					
					
					@endforeach
				
				
				</table>
			</div>
		</div>
		<!-- END Table Sections -->
	</div>
	
	<!--Completed-->
	<div class="content bg-gray-lighter">
		<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
		<div class="block">
			<div class="block-header">
				<h3 class="block-title">GET HELP (
					<small>COMPLETED</small>
					)
				</h3>
			</div>
			<div class="block-content">
				
				<table class="js-table-sections table table-hover">
					<thead>
					<tr>
						<th style="width: 30px;"></th>
						<th style="width: 30px;">#</th>
						<th>Amount Received</th>
						<th>Partner</th>
						<th style="width: 15%;">Date Created</th>
						<th style="width: 15%;">Status</th>
					</tr>
					</thead>
					@if(empty($completeds))
						<tbody class="js-table-sections-header">
						<tr>
							<td class="text-center" colspan="10">
								You currently do not have any completed GET HELP
							</td>
						</tr>
						</tbody>
					@endif
					@foreach($completeds as $key => $completed)
						<tbody class="js-table-sections-header  {{$key==0 ? 'open' : ''}}">
						<tr>
							<td class="text-center">
								<i class="fa fa-angle-right"></i>
							</td>
							<th style="width: 30px;">{{++$key}}</th>
							<td class="font-w600">{{$completed->sum('amount_received')}}</td>
							<td>
								<span class="label label-info">Matched</span>
							</td>
							<td class="font-w600">{{$completed->created_at}}</td>
							
							<td class="hidden-xs">
							</td>
						</tr>
						</tbody>
						
						<tbody>
						
						@foreach($completed->matchedList as $key2=> $matchMe)
							<tr>
								<th style="width: 30px;"></th>
								<th style="width: 30px;">{{++$key2}}</th>
								
								<td class="font-w600 text-success">+ {{$completed->amount_received}}</td>
								<td>
									<small>{{$matchMe->getHelp->user->client->first_name}} {{$matchMe->getHelp->user->client->last_name}}
										<br/>{{$matchMe->getHelp->user->phone}}</small>
								</td>
								<td class="font-w600 text-success"> {{$completed->created_at}}</td>
								<td>
									<span class="label label-warning">{{$completed->status}}</span>
								</td>
							</tr>
						@endforeach
						</tbody>
					@endforeach
				</table>
			</div>
		</div>
		<!-- END Table Sections -->
	</div>

@stop


@section('extra_js')
	<script src="{{asset('assets/js/countdown/jquery.countdown.min.js')}}"></script>
	
	<!-- Page JS Code -->
	<script>
        jQuery(function () {
            // Init page helpers (Table Tools helper)
            App.initHelpers('table-tools');

        });
	
	
	</script>

@stop