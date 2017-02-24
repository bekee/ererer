@extends('layouts.client')

@section('title')
	{{env('APP_NAME')}} My Referral
@stop

@section('dashboard')
	My Referral
@stop

@section('content')
	<div class="col-lg-12">
		<div class="col-lg-9">
			<div class="content bg-gray-lighter">
				<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
				<div class="block-content ">
					
					<p class="text-center text-danger btn btn-success center-block" >My Referral
						Link <span id="message">{{auth()->user()->client->ref_url}}</span> <span data-toggle="tooltip" title="Copy"
						                                               class="fa fa-copy pull-right" onclick="copyToClipboard('message')"></span></p>
				
				</div>
				
				<div class="block">
					<div class="block-header">
						<h3 class="block-title">My Referral
						</h3>
					</div>
					
					<div class="block-content">
						<table class="table table-hover">
							<thead>
							<tr>
								<th class="text-center" style="width: 50px;">#</th>
								<th>Referred</th>
								<th>Date</th>
							</tr>
							</thead>
							<tbody>
							@if(empty($referrals))
								<tr>
									<td class="text-center" colspan="3">You have referred No ONE</td>
								</tr>
							@endif
							@foreach($referrals as $key => $referral)
								<tr>
									<td class="text-center">{{++$key}}</td>
									<td>{{$referral->Ireferred->client->first_name}} {{$referral->Ireferred->client->last_name}} </td>
									<td>{{\Carbon\Carbon::parse( $referral->created_at)->diffForHumans()}}</td>
								</tr>
							@endforeach
							</tbody>
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
	<script>
        function copyToClipboard(elementId) {
            var aux = document.createElement("input");
            aux.setAttribute("value", document.getElementById(elementId).innerHTML);
            document.body.appendChild(aux);
            aux.select();
            document.execCommand("copy");

            document.body.removeChild(aux);

        }
	</script>

@stop