<?php

use App\Setting;
use Illuminate\Database\Seeder;

class OtherSettingSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$otherSetting = new Setting();
		$otherSetting->bonus_min_amount_withdrawal = 10000;
		$otherSetting->max_referral_bonus_per_referrer = 10;
		$otherSetting->expected_matching_days = 21;
		$otherSetting->allowed_payment_hours = 24;
		$otherSetting->save();
	}
}
