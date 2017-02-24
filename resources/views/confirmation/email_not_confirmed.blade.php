@extends('layouts.email')

@section('title')
	PayMe Email Confirmation
@stop

@section('header')
	Email Confirmation
@stop


@section('first_message')
	Your email have not been confirmed yet
@stop

@section('content')
	<div class="block block-rounded">
		<div class="block-content">
			
			<div class="alert alert-warning font-w600 text-center">
				<i class="fa fa-warning"></i> Attention... {{" ".auth()->user()->client->first_name." "}} Kindly confirm your email
			</div>
			
			
			<p class="font-w600">Use the link below:</p>
			<ul class="fa-ul list-simple-mini push">
				<li>
					<i class="fa fa-check fa-li text-success"></i>
					I did not receive any email, <a href="{{url('dashboard/resend_email')}}" class="btn btn-danger btn-sm">RESEND
						EMAIL</a>
				</li>
			</ul>
		</div>
	</div>
@stop