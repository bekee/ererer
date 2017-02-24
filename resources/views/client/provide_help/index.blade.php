@extends('layouts.client')
@section('title')
	{{env('APP_NAME')}} Provide Help
@stop

@section('dashboard')
	Provide Help
@stop
@section('content')
	<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
	<script src="{{asset('assets/js/countdown/jquery.countdown.min.js')}}"></script>
	
	<div class="col-lg-12">
		<div class="col-lg-9">
			<div class="content">
				<div class="block pull-right">
					<a class="btn btn-success" href="{{url('dashboard')}}">PROVIDE HELP <span class="fa fa-key"></span></a>
				</div>
			</div>
			
			<div class="content bg-gray-lighter">
				<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
				<div class="block">
					<div class="block-header">
						<h3 class="block-title">My Provide Help (
							<small>UNMATCHED</small>
							)
						</h3>
					</div>
					<div class="block-content">
						
						<table class="js-table-sections table table-hover">
							<thead>
							<tr>
								
								<th>#</th>
								<th>Provided Amount</th>
								<th>Unmatched Balance</th>
								<th class="hidden-xs" style="width: 15%;">Date Created</th>
								<th class="hidden-xs" style="width: 15%;">Expected Matching Date</th>
								<th style="width: 15%;">Status</th>
							</tr>
							</thead>
							
							@if(empty($unmatcheds))
								<tbody class="js-table-sections-header open">
								<tr>
									<td class="text-center" style="width: 15%;" colspan="5">
										You currently do not have any unmatched provide help
									</td>
								</tr>
								</tbody>
							@endif
							
							@foreach($unmatcheds as $key => $unmatched)
								<tbody class="js-table-sections-header">
								<tr>
									
									<td class="">{{++$key}}</td>
									<td class="font-w600">{{env('CURRENCY_SYMBOL').' '.number_format($unmatched->amount,2)}}</td>
									<td class="font-w100 text-amethyst">{{env('CURRENCY_SYMBOL').' '.number_format($unmatched->amount-$unmatched->amount_paid,2)}}</td>
									
									<td class="hidden-xs">
										<em class="text-muted">{{\Carbon\Carbon::parse($unmatched->created_at)->diffForHumans()}}</em>
									
									</td>
									<td class="hidden-xs">
										<em class="text-muted"
										    id="vv{{$unmatched->id}}">{{$unmatched->expected_match_date}}</em>
										<script>
                                            $("#vv{{$unmatched->id}}").countdown("{{\Carbon\Carbon::parse($unmatched->expected_match_date)}}", function (event) {
                                                $(this).html(event.strftime('%D days %H:%M:%S'));
                                            });
										</script>
									</td>
									<td>
										@if(\Carbon\Carbon::parse($unmatched->expected_match_date)->greaterThan(\Carbon\Carbon::now()))
											<span class="label label-info">
												{{$unmatched->status}}
											</span>
										@elseif(($unmatched->amount - $unmatched-amount_paid) >0)
											<span class="label label-primary">
												Not Fully Matched
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
			
			
			<!----Matched-->
			<div class="content bg-gray-lighter">
				<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
				<div class="block" >
					<div class="block-header">
						<h3 class="block-title">PROVIDE HELP (
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
								<th>Provided Amount</th>
								<th>Partner</th>
								<th>Partner Account Detail</th>
								<th>Matched Amount</th>
								<th>Unmatched Balance</th>
								
								<th class="hidden-xs" style="width: 15%;">Time Left</th>
								<th class="hidden-xs" style="width: 15%;">Upload Proof</th>
								<th style="width: 15%;">Status</th>
							</tr>
							</thead>
							@if(($matches->isEmpty()))
								<tbody class="js-table-sections-header">
								<tr>
									<td class="text-center" colspan="11">
										You currently do not have any matched provide help
									</td>
								</tr>
								</tbody>
							@endif
							@foreach($matches as $key => $matching)
								<tbody class="js-table-sections-header  {{$key==0 ? 'open1' : ''}}">
								<tr>
									<td class="text-center"><i class="fa fa-angle-right"></i></td>
									<th class="text-center">{{++$key}}</th>
									<td class="">{{env('CURRENCY_SYMBOL').' '.number_format($matching->amount)}}</td>
									<td></td>
									<td><span class="label label-info">Matched</span></td>
									<td class="font-w600"></td>
									<td class="font-w600">{{env('CURRENCY_SYMBOL').' '.number_format($matching->amount - $matching->amount_paid)}}</td>
									
									<td></td>
									<td></td>
									<td class="hidden-xs"></td>
								</tr>
								</tbody>
								<tbody>
								
								@foreach($matching->matchedList as $key2=> $matchMe)
									@if($matchMe->action_check =='published')
										<tr>
											<th style="width: 30px;"></th>
											<th class="text-center">{{++$key2}}</th>
											<td class="font-w600 text-danger">+ {{env('CURRENCY_SYMBOL').' '.number_format($matching->amount)}}</td>
											<td>
												<small>{{$matchMe->getHelp->user->client->first_name}} {{$matchMe->getHelp->user->client->last_name}}
													<br/>{{$matchMe->getHelp->user->phone}}</small>
											</td>
											<td>
												<small>{{$matchMe->getHelp->user->ClientBank->acc_name}} <br/>
													{{$matchMe->getHelp->user->ClientBank->acc_number}}
													{{$matchMe->getHelp->user->ClientBank->bank->name}}</small>
											</td>
											<td class="font-w600 text-success">+ {{env('CURRENCY_SYMBOL').' '.number_format($matchMe->matched_amount)}}</td>
											<td></td>
											
											<td>
												@if(empty($matchMe->proof))
													<small class="text-muted" id="{{$key.$key2}}"></small>
												@else
													<small class="text-muted">Waiting for partner to confirm payment</small>
												@endif
												
												<script>
                                                    $("#{{$key.$key2}}").countdown("{{$matchMe->provideHelp->timer->more_time
										?  \Carbon\Carbon::parse($matchMe->provideHelp->timer->date_time_to)->addHour($matchMe->provideHelp->timer->more_time) :
									\Carbon\Carbon::parse($matchMe->provideHelp->timer->date_time_to)}}", function (event) {
                                                        $(this).html(event.strftime(' %H:%M:%S'));
                                                    });
												</script>
											</td>
											
											
											<td>
												@if(empty($matchMe->proof))
													{!! Form::model($matching,array('url' => ["dashboard/upload_proof",$matchMe->id],'method'=>'PATCH','files'=>true,'class'=>'form-horizontal push-10-t push-10','id'=>"tel$matching->id")) !!}
													{!! Form::file('teller',['class'=>'btn btn-default teller','title'=>'Upload Teller','id'=>'teller']) !!}
													{!! Form::close() !!}
												@else
													
													<img src="{{Storage::disk('teller')->url('images/teller/'.$matchMe->proof)}}"
													     height="50px" width="50px">
													<a href="{{Storage::disk('teller')->url('images/teller/'.$matchMe->proof)}}">View
														Teller</a>
												@endif
											</td>
											
											<td>
												@if(empty($matchMe->proof))
													<span class="label label-info">{{$matching->status}}</span>
												@else
													<span class="label label-primary">Waiting Partner Approval</span>
												@endif
												
											</td>
										</tr>
									@endif
								@endforeach
								</tbody>
							
							@endforeach
						
						
						</table>
					</div>
				</div>
				<!-- END Table Sections -->
			</div>
			
			
			<!----GROWTH---->
			<div class="content bg-gray-light">
				<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
				<div class="block">
					<div class="block-header">
						<h3 class="block-title">MY GROWTH CYCLE</h3>
					</div>
					
					<div class="block-content">
						
						<table class="table table-hover">
							<thead>
							<tr>
								<th style="width: 30px;">#</th>
								<th>Provided Amount</th>
								<th >INCREASE %</th>
								<th class="hidden-xs" >Current Value</th>
							
								<th >Status</th>
							</tr>
							</thead>
							
							@if(($growths->isEmpty()))
								<tbody class="js-table-sections-header">
								<tr>
									<td class="text-center" colspan="6">
										You currently do not have any GROWTH CIRCLE RUNNING
									</td>
								</tr>
								</tbody>
							@endif
							
							<tbody>
							@foreach($growths as $growth)
								<tr>
									<td class="font-w600"></td>
									<td class="font-w600 text-success">{{env('CURRENCY_SYMBOL').' '.number_format($growth->provideHelp->amount)}}</td>
									<td class="font-w600 text-success">{{$growth->percentage}}</td>
									<td class="font-w600 text-success">{{env('CURRENCY_SYMBOL').' '.number_format($growth->amount_grown)}}</td>
									<td>
										@if($growth->total_growth == $growth->maturity_days)
											@if($growth->provideHelp->status =='withdrawn')
												<span class="btn btn-sm btn-danger">Money Withdrawn to MyWallet</span>
											@else
												<a href="{{url('dashboard/to_wallet/'.$growth->amount_grown)}}"
												   class="btn btn-danger">Withdraw to wallet<span
															class="fa fa-bank"></span></a>
											@endif
										@else
											<span class="btn btn-sm btn-danger">Money Still Growing</span>
										@endif
									</td>
								</tr>
							@endforeach
							</tbody>
						
						
						</table>
					</div>
				</div>
				<!-- END Table Sections -->
			</div>
			
			
			<!--Cancelled-->
			<div class="content bg-gray-lighter">
				<div class="block" >
					<div class="block-header">
						<h3 class="block-title">PROVIDE HELP (
							<small>CANCELLED</small>
							)
						</h3>
					</div>
					<div class="block-content">
						
						<table class="js-table-sections table table-hover">
							<thead>
							<tr>
								<th style="width: 30px;"></th>
								<th style="width: 30px;">#</th>
								<th>Failed Amount</th>
								<th>Partner</th>
								<th style="width: 15%;">Date Created</th>
								<th style="width: 15%;">Status</th>
							</tr>
							</thead>
							@if(($cancelleds->isEmpty()))
								<tbody class="js-table-sections-header">
								<tr>
									<td class="text-center" colspan="10">
										You currently do not have any cancelled PROVIDE HELP
									</td>
								</tr>
								</tbody>
							@endif
							@foreach($cancelleds as $key => $cancelled)
								<tbody class="js-table-sections-header  {{$key==0 ? 'open' : ''}}">
								<tr>
									<td class="text-center">
										<i class="fa fa-angle-right"></i>
									</td>
									<th style="width: 30px;">{{++$key}}</th>
									<td class="font-w600"></td>
									<td>
										<span class="label label-info">Matched</span>
									</td>
									
									<td></td>
									<td class="hidden-xs">
									</td>
								</tr>
								</tbody>
								
								<tbody>
								
								@foreach($cancelled->matchedList->where('status','cancelled') as $key2=> $matchMe)
									<tr>
										<th style="width: 30px;"></th>
										<th style="width: 30px;">{{++$key2}}</th>
										
										<td class="font-w600 text-danger">
											+ {{env('CURRENCY_SYMBOL').' '.number_format($matchMe->MatchedTransaction->matched_amount)}}</td>
										
										<td>
											<small>{{$matchMe->getHelp->user->client->first_name}} {{$matchMe->getHelp->user->client->last_name}}
												<br/>{{$matchMe->getHelp->user->phone}}</small>
										</td>
										<td>
											{{$matchMe->created_at}}
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


@section('extra_js')
	<script src="{{asset('assets/js/countdown/jquery.countdown.min.js')}}"></script>
	
	<!-- Page JS Code -->
	<script>
        jQuery(function () {
            // Init page helpers (Table Tools helper)
            App.initHelpers('table-tools');

            $(document).ready(function () {

                $(".teller").change(function () {

                    var formId = $(this).parent().attr('id');
                    $("#" + formId).submit();
                });
            });


        });
	
	
	</script>

@stop