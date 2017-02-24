@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Matches
@stop

@section('content_body')
	<div class="row">
		<div class="col-lg-12">
			<h3>{{$provideHelp->user->client->first_name}} {{$provideHelp->user->client->last_name}} provides help
				of {{number_format($provideHelp->amount,2)}}, current balance of
				<strong>{{number_format($provideHelp->amount - $provideHelp->amount_paid,2)}}</strong></h3>
		</div>
		<div class="col-lg-12">
			
			{!! Form::open(array('url' => ['admin/match',$provideHelp->id],'class'=>'form-horizontal push-10-t push-10')) !!}
			<div class="block">
				<div class="block-header">
					<h3 class="block-title">Match Lists</h3>
				</div>
				<div class="block-content">
					<div class="block-content">
						<table class="table table-hover">
							<thead>
							<tr>
								<th class="text-center" style="width: 50px;">#</th>
								<th>GET Amount</th>
								<th>Un-Matched Balance</th>
								<th>Partner</th>
								<th>Date Created</th>
								<th>Enter Amount</th>
							
							</tr>
							</thead>
							
							@if(empty($getHelps))
								<tbody class="js-table-sections-header">
								<tr>
									<td class="text-center" colspan="10">
										You currently do not have any matched provide help
									</td>
								</tr>
								</tbody>
							@endif
							<tbody>
							@foreach($getHelps as $key => $getHelp)
								@if($getHelp->amount != $getHelp->amount_received)
									<tr>
										<td class="text-center">{{++$key}}</td>
										<td>{{env('CURRENCY_SYMBOL')." ".number_format($getHelp->amount,2)}}</td>
										<td class="font-w100 text-amethyst">{{env('CURRENCY_SYMBOL')." ".number_format($getHelp->amount-$getHelp->amount_received,2)}}</td>
										<td>{{$getHelp->user->client->first_name}} {{$getHelp->user->client->last_name}}</td>
										<td> {{\Carbon\Carbon::parse( $getHelp->created_at)->diffForHumans()}}</td>
										<td>
											{!! Form::number('amount[]',0.0,['class'=>'form-control']) !!}
											{!! Form::hidden('id[]',$getHelp->id) !!}
										
										
										</td>
									</tr>
								@endif
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="form-group ">
				{!! Form::submit('SAVE',['class'=>'btn btn-sm  btn-primary col-sm-offset-6']) !!}
			</div>
			{!! Form::close() !!}
		</div>
	</div>
@stop
