<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OtherSettingRequest;
use App\Setting;

class OtherSettingController extends Controller
{
	public function index()
	{
		$setting = Setting::first();
		
		return view('admin.setting.index', compact('setting'));
	}
	
	public function update(OtherSettingRequest $request)
	{
		$otherSetting = Setting::first();
		$otherSetting->bonus_min_amount_withdrawal = $request->bonus_min_amount_withdrawal;
		$otherSetting->max_referral_bonus_per_referrer = $request->max_referral_bonus_per_referrer;
		$otherSetting->expected_matching_days = $request->expected_matching_days;
		$otherSetting->allowed_payment_hours = $request->allowed_payment_hours;
		$otherSetting->maturity_days = $request->maturity_days;
		$otherSetting->save();
		flash("Setting successfully updated", 'success');
		return redirect()->back();
	}
}
