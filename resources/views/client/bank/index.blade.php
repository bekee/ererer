@extends('layouts.client')

@section('title')
	{{env('APP_NAME')}} My Bank
@stop
@section('dashboard')
	My Bank
@stop
@section('content')
	<div class="content bg-gray-lighter">
		<!-- Table Sections (.js-table-sections class is initialized in App() -> uiHelperTableToolsSections()) -->
		<div class="block">
			<div class="block-header">
				<h3 class="block-title">My Bank</h3>
			</div>
			<div class="block-content">
				
				<div class="row">
					
					<div class="col-lg-6">
						<!-- Material (floating) Login -->
						<div class="block block-themed">
							<div class="block-header bg-primary">
								<ul class="block-options">
									<li>
										<button type="button" data-toggle="block-option"
										        data-action="content_toggle"></button>
									</li>
								</ul>
								<h3 class="block-title">Add New Bank Detail</h3>
							</div>
							<div class="block-content">
								
								@if(!empty(auth()->user()->ChangeBank))
									@if(auth()->user()->ChangeBank->grant=='1')
										{!! Form::model($bank,array('url' => ['dashboard/update_bank',$bank->id],'method'=>'PATCH','class'=>'form-horizontal push-10-t push-10')) !!}
									@else
										{!! Form::open(array('url' => 'dashboard/add_bank','class'=>'form-horizontal push-10-t push-10')) !!}
									@endif
								@else
									{!! Form::open(array('url' => 'dashboard/add_bank','class'=>'form-horizontal push-10-t push-10')) !!}
								@endif
								
								<div class="form-group">
									<div class="col-xs-12">
										<div class="form-material form-material-success">
											{!! Form::text('acc_name',null,['class'=>'form-control']) !!}
											@if ($errors->has('acc_name'))
												<span class="help-block">
                                        <strong>{{ $errors->first('acc_name') }}</strong>
                                    </span>
											@endif
											<label for="login3-username">Account Name</label>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<div class="form-material form-material-success">
											{!! Form::text('acc_number',null,['class'=>'form-control']) !!}
											@if ($errors->has('acc_number'))
												<span class="help-block">
                                        <strong>{{ $errors->first('acc_number') }}</strong>
                                    </span>
											@endif
											<label for="login3-username">Account Number</label>
										</div>
									</div>
								</div>
								
								
								<div class="form-group">
									<div class="col-xs-12">
										<div class="form-material floating">
											{{ Form::select('bank_id', [
											   'Bank' => [''=>''] + $banks->toArray(),
											   ],null,['class'=>'form-control selectpicker']
											) }}
											@if ($errors->has('bank_id'))
												<span class="help-block">
                                        <strong>{{ $errors->first('bank_id') }}</strong>
                                    </span>
											@endif
											<label for="login3-username">My Bank</label>
										</div>
									</div>
								</div>
								@if(empty($bank))
									<div class="form-group">
										<div class="col-xs-12">
											<button class="btn btn-sm btn-primary" type="submit"><i
														class="fa fa-arrow-right push-5-r"></i> Add New
											</button>
										</div>
									</div>
								@endif
								@if(!empty(auth()->user()->ChangeBank))
									@if(auth()->user()->ChangeBank->grant=='1')
										<div class="form-group">
											<div class="col-xs-12">
												<button class="btn btn-sm btn-primary" type="submit"><i
															class="fa fa-arrow-right push-5-r"></i> Update Bank
												</button>
											</div>
										</div>
									@endif
								@endif
								{!! Form::close() !!}
							</div>
						</div>
						<!-- END Material (floating) Login -->
					</div>
					<div class="col-lg-6">
						<!-- Hover Table -->
						<div class="block">
							<div class="block-header">
								<h3 class="block-title">My Bank Detail</h3>
							</div>
							<div class="block-content">
								<div class="col-sm-12">
									<div class="col-sm-3"><h5>Account Name </h5></div>
									<div class="col-sm-3">: <em>{{empty($bank) ? 'Nil' : $bank->acc_name }}</em></div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-3"><h5>Account Number </h5></div>
									<div class="col-sm-3">: <em>{{empty($bank) ? 'Nil' : $bank->acc_number }}</em></div>
								</div>
								<div class="col-sm-12">
									<div class="col-sm-3"><h5>Bank </h5></div>
									<div class="col-sm-3">: <em>{{empty($bank) ? 'Nil' : $bank->bank->name }}</em></div>
								</div>
							</div>
						</div>
						
						<!-- END Hover Table -->
					</div>
					@if(!empty($bank))
					<div class="col-lg-6">
						<div class="block pull-right">
							<div class="block-header">
								<h3 class="block-title">Change Account Request Form</h3>
							</div>
							<div class="block-content">
							
									{!! Form::open(array('url' => 'dashboard/change_bank','class'=>'form-horizontal push-10-t push-10')) !!}
									<div class="form-group">
										<div class="col-xs-12">
											<div class="form-material form-material-success">
												{!! Form::textarea('change_acc',null,['class'=>'form-control']) !!}
												@if ($errors->has('change_acc'))
													<span class="help-block">
                                                    <strong>{{ $errors->first('change_acc') }}</strong>
                                                </span>
												@endif
												<label for="login3-username">Write Reason to Change Account
													Number</label>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="pull-right btn-sm">{{Form::submit('POST',['class'=>'btn btn-info'])}}</div>
									</div>
									{!! Form::close() !!}
							
							</div>
						</div>
					</div>
				
				</div>
				@endif
			</div>
		</div>
		<!-- END Table Sections -->
	</div>

@stop
