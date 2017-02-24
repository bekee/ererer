@extends('layouts.email')


@section('title')
	PayMe Email Verification
@stop

@section('header')
	Email Verification
@stop


@section('first_message')
	A confirmation email have been sent
@stop

@section('content')
	<div class="block block-rounded">
		<div class="block-content">
			
			<div class="alert alert-info font-w600 text-center">
				<i class="fa fa-angellist"></i> Attention... Kindly confirm your email
			</div>
			
			
			<p class="font-w600">Hello {{auth()->user()->client->first_name}} </p>
			<ul class="fa-ul list-simple-mini push">
				<li>
					<i class="fa fa-check fa-li text-success"></i>
					A confirmation email have been sent to you
				</li>
			</ul>
		</div>
	</div>
@stop