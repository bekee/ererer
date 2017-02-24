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
					<h3 class="block-title">All Provide Helps</h3>
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
						@foreach($provideHelps as $key => $provideHelp)
							
						@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!-- END Hover Table -->
		</div>
	
	</div>
@stop
