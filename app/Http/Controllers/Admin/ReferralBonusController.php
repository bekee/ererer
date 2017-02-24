<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ReferralBonusRequest;
use App\ReferralBonus;

class ReferralBonusController extends Controller
{
	public function index()
	{
		$referral_bonuses = ReferralBonus::paginate(100);
		return view('admin.bonus.index', compact('referral_bonuses'));
	}
	
	public function newBonus(ReferralBonusRequest $request)
	{
		$referral_bonuses = new ReferralBonus();
		$referral_bonuses->amount = $request->amount;
		$referral_bonuses->percentage = $request->percentage;
		$referral_bonuses->referral_count = $request->referral_count;
		$referral_bonuses->user_type = $request->user_type;
		$referral_bonuses->save();
		
		flash("New Bonus have been added");
		
		return redirect()->back();
	}
}
