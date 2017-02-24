@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Matches
@stop

@section('content_body')
	<div class="row"><h4 class="text-center">UnMatched Lists</h4></div>
	<div class="row">
		<div class="col-lg-6">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Provide Helps</h3>
				</div>
				<div class="block-content">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>Amount Provided</th>
							<th>Un-Matched Balance</th>
							<th>Partner</th>
							<th>Date Created</th>
							<th>Expected Matching Date</th>
							<th class="text-center" style="width: 100px;">Actions</th>
						</tr>
						</thead>
						<tbody>
						@foreach($provideHelps as $key => $provideHelp)
							@if($provideHelp->amount != $provideHelp->amount_paid)
								<tr>
									<td class="text-center">{{++$key}}</td>
									<td>{{number_format($provideHelp->amount,2)}}</td>
									<td class="font-w100 text-amethyst">{{env('CURRENCY_SYMBOL')." ".number_format($provideHelp->amount-$provideHelp->amount_paid,2)}}</td>
									<td>{{$provideHelp->user->client->first_name}} {{$provideHelp->user->client->last_name}}
										<br/> {{$provideHelp->user->email}} <br/>{{$provideHelp->user->phone}}</td>
									<td> {{\Carbon\Carbon::parse( $provideHelp->created_at)->diffForHumans()}}</td>
									<td> {{\Carbon\Carbon::parse( $provideHelp->expected_match_date)->diffForHumans()}}</td>
									<td class="text-center">
										<div class="btn-group">
											<a href='{{url("admin/match/$provideHelp->id")}}'
											   class="btn btn-xs btn-danger"
											   type="button" data-toggle="tooltip"
											   title="Match Partner"><i class="fa fa-angellist"></i></a>
										</div>
									</td>
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- END Hover Table -->
		</div>
		<div class="col-lg-6">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Get Helps</h3>
				</div>
				<div class="block-content">
					<table class="table table-hover">
						<thead>
						<tr>
							<th class="text-center" style="width: 50px;">#</th>
							<th>GET Amount</th>
							<th>Un-Matched Balance</th>
							<th>Partner</th>
							<th>Date Created</th>
						
						
						</tr>
						</thead>
						<tbody>
						@foreach($getHelps as $key => $getHelp)
							@if($getHelp->amount != $getHelp->amount_received)
								<tr>
									<td class="text-center">{{++$key}}</td>
									<td>{{env("CURRENCY_SYMBOL")." ".number_format($getHelp->amount,2)}}</td>
									<td class="font-w100 text-amethyst">{{env("CURRENCY_SYMBOL")." ".number_format($getHelp->amount-$getHelp->amount_received,2)}}</td>
									<td>{{$getHelp->user->client->first_name}} {{$getHelp->user->client->last_name}}</td>
									<td> {{\Carbon\Carbon::parse( $getHelp->created_at)->diffForHumans()}}</td>
								</tr>
							@endif
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- END Hover Table -->
		</div>
	</div>
	
	
	<div class="row">
		
		<div class="col-lg-12">
			<!-- Hover Table -->
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Saved Matches</h3>
					<div class="pull-right"><a href="{{url('admin/clear')}}" class="btn btn-sm btn-danger"
					                           style="margin-right: 8px;">CLEAR
						</a>
						<a href="{{url('admin/publish')}}" class="btn btn-sm btn-success">Publish
							Now</a></div>
				</div>
				<div class="block-content">
					<table class="js-table-sections table table-hover">
						<thead>
						<tr>
							<th style="width: 30px;"></th>
							<th style="width: 30px;">#</th>
							<th>Provided Amount</th>
							<th>Matched Amount</th>
							<th>Remaining Balance</th>
							<th>Partner</th>
							<th>Partner Account Detail</th>
							<th style="width: 15%;">Status</th>
						</tr>
						</thead>
						@if(($saves->isEmpty()))
							<tbody class="js-table-sections-header">
							<tr>
								<td class="text-center" colspan="10">
									You currently do not have any matched provide help
								</td>
							</tr>
							</tbody>
						@endif
						@foreach($saves as $key => $match)
							<tbody class="js-table-sections-header ">
							<tr>
								<td class="text-center">
									<i class="fa fa-angle-right"></i>
								</td>
								<th style="width: 30px;" class="text-danger">{{++$key}}</th>
								<td class="font-w600 text-danger"><span><small
												class="fa fa-long-arrow-down"></small></span>{{env('CURRENCY_SYMBOL')." ".number_format($match->provideHelp->amount,2)}}
								</td>
								
								<th class="text-danger">{{env('CURRENCY_SYMBOL')." ".number_format($match->where('provide_help_id',$match->provideHelp->id)->sum('matched_amount'),2)}}</th>
								
								<td class="font-w100 text-danger">{{env('CURRENCY_SYMBOL')." ".number_format($match->provideHelp->amount - $match->provideHelp->amount_paid,2)}}</td>
								<td class="text-danger">{{$match->provideHelp->user->client->first_name}} {{$match->provideHelp->user->client->last_name}}</td>
								<td class="text-danger">
									<span class="label label-info">Matched</span>
								</td>
								<td class="hidden-xs text-danger">
								</td>
							</tr>
							</tbody>
							<tbody>
							@foreach($match->provideHelp as $key2 => $getHelp)
								<tr>
									<td class="text-center">
									</td>
									<th style="width: 30px;" class="text-success">{{var_dump($key2)}}</th>
								</tr>
							@endforeach
							</tbody>
						@endforeach
					</table>
				</div>
			</div>
			<!-- END Hover Table -->
		</div>
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