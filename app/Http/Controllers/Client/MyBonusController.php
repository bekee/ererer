<?php

namespace App\Http\Controllers\Client;

use App\FirstTimeBonus;
use App\Http\Controllers\Controller;
use App\MyWallet;
use App\UserReferralBonus;

class MyBonusController extends Controller
{
	public function index()
	{
		$first_time_bonus = FirstTimeBonus::where('user_id', auth()->user()->id)->first();
		$referralsBonuses = UserReferralBonus::where('user_id', auth()->user()->id)->paginate(25);
		
		return view('client.bonus.index', compact('first_time_bonus', 'referralsBonuses'));
	}
	
	public function withdraw($id)
	{
		$first_time_bonus = FirstTimeBonus::findOrFail($id);
		$mywallet = new MyWallet();
		$mywallet->user_id = auth()->user()->id;
		$mywallet->amount = $first_time_bonus->amount_gained;
		$mywallet->purpose = "First Time Bonus";
		$mywallet->state = "in";
		$mywallet->save();
		
		flash("You have successfully moved " . env("CURRENCY_SYMBOL") . " " . $mywallet->amount . " to wallet", 'success');
		return redirect()->back();
	}
	
	public function BonusWithdraw()
	{
		$referralsBonuses = UserReferralBonus::where('user_id', auth()->user()->id)->where('status', 'approved')->get();
		
		$mywallet = new MyWallet();
		$mywallet->user_id = auth()->user()->id;
		$mywallet->amount = $referralsBonuses->sum('amount');
		$mywallet->purpose = "First Time Bonus";
		$mywallet->state = "in";
		$mywallet->save();
		
		
		foreach ($referralsBonuses as $referralsBonus) {
			$referrals = UserReferralBonus::find($referralsBonus->id);
			$referrals->status = 'withdrawn';
			$referrals->update();
		}
		
		flash("You have successfully moved " . env('CURRENCY_SYMBOL') . " " . $mywallet->amount . " to wallet", 'success');
		return redirect()->back();
	}
}
