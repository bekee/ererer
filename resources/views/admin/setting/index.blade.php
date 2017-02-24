@extends('layouts.admin')

@section('title')
	{{env('APP_NAME')}} Other Settings
@stop

@section('content_body')
	<div class="row">
		
		<div class="col-lg-12">
			<!-- Material (floating) Login -->
			<div class="block block-themed">
				<div class="block-header bg-primary">
					<ul class="block-options">
						<li>
							<button type="button" data-toggle="block-option" data-action="content_toggle"></button>
						</li>
					</ul>
					<h3 class="block-title">Update Setting</h3>
				</div>
				<div class="block-content">
					{!! Form::model($setting,array('url' => ['admin/other_setting',$setting->id],'method'=>'PATCH','class'=>'form-horizontal push-10-t push-10')) !!}
					<div class="form-group">
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('bonus_min_amount_withdrawal',null,['class'=>'form-control']) !!}
								@if ($errors->has('bonus_min_amount_withdrawal'))
									<span class="help-block">
                                        <strong>{{ $errors->first('bonus_min_amount_withdrawal') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Minimum Bonus Withdrawal</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('max_referral_bonus_per_referrer',null,['class'=>'form-control']) !!}
								@if ($errors->has('max_referral_bonus_per_referrer'))
									<span class="help-block">
                                        <strong>{{ $errors->first('max_referral_bonus_per_referrer') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Maximum Referral Transactions</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('expected_matching_days',null,['class'=>'form-control']) !!}
								@if ($errors->has('expected_matching_days'))
									<span class="help-block">
                                        <strong>{{ $errors->first('expected_matching_days') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Expected Matching Days</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('allowed_payment_hours',null,['class'=>'form-control']) !!}
								@if ($errors->has('allowed_payment_hours'))
									<span class="help-block">
                                        <strong>{{ $errors->first('allowed_payment_hours') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Allowed Payment Hours</label>
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-xs-3">
							<div class="form-material floating">
								{!! Form::text('maturity_days',null,['class'=>'form-control']) !!}
								@if ($errors->has('maturity_days'))
									<span class="help-block">
                                        <strong>{{ $errors->first('maturity_days') }}</strong>
                                    </span>
								@endif
								<label for="login3-username">Expected Maturity Days</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-12">
						<button class="btn btn-sm btn-primary" type="submit"><i
									class="fa fa-arrow-right push-5-r"></i> Update
						</button>
					</div>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
		<!-- END Material (floating) Login -->
	</div>
	
	</div>
@stop
