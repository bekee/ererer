<?php

namespace App\Http\Controllers\Client;

use App\ClientReferral;
use App\Http\Controllers\Controller;

class MyReferralController extends Controller
{
	public function index()
	{
		$referrals = ClientReferral::where('user_id', auth()->user()->id)->paginate(100);
		
		return view('client.referral.index', compact('referrals'));
    }
}
