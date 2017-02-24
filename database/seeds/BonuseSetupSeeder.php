<?php

use App\ReferralBonus;
use Illuminate\Database\Seeder;

class BonuseSetupSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		
		//first timer
		$bank = new ReferralBonus();
		$bank->amount = 5000;
		$bank->user_type = 'first-time';
		$bank->percentage = 5;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->amount = 10000;
		$bank->user_type = 'first-time';
		$bank->percentage = 7;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->amount = 25000;
		$bank->user_type = 'first-time';
		$bank->percentage = 15;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->amount = 50000;
		$bank->user_type = 'first-time';
		$bank->percentage = 40;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->amount = 100000;
		$bank->user_type = 'first-time';
		$bank->percentage = 50;
		$bank->save();
		
		//Referral
		$bank = new ReferralBonus();
		$bank->referral_count = 10;
		$bank->user_type = 'referral';
		$bank->percentage = 5;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->referral_count = 20;
		$bank->user_type = 'referral';
		$bank->percentage = 7;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->referral_count = 30;
		$bank->user_type = 'referral';
		$bank->percentage = 15;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->referral_count = 50;
		$bank->user_type = 'referral';
		$bank->percentage = 40;
		$bank->save();
		
		$bank = new ReferralBonus();
		$bank->referral_count = 80;
		$bank->user_type = 'referral';
		$bank->percentage = 50;
		$bank->save();
	}
}
