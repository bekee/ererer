<?php

namespace App\Http\Controllers\Client;

use App\ClientCycleGrowth;
use App\ClientReferral;
use App\CycleGrowth;
use App\GetHelp;
use App\Http\Controllers\Controller;
use App\Http\Requests\FileUploadRequest;
use App\Match;
use App\MyWallet;
use App\Notifications\PartnerApprove;
use App\ProvideHelp;
use App\ReferralBonus;
use App\Setting;
use App\Timer;
use App\User;
use App\UserReferralBonus;
use Carbon\Carbon;

class MyProofController extends Controller
{
	public function proof($id, FileUploadRequest $request)
	{
		$path = $request->file('teller')->store(auth()->user()->id, 'teller');
		$match = Match::findOrFail($id);
		$match->proof = $path;
		$match->save();
		
		$provideHelp = ProvideHelp::find($match->provide_help_id);
		$provideHelp->amount_paid = $provideHelp->amount_paid + $match->getHelp->amount;
		$provideHelp->update();
		
		$timer = new Timer();
		$timer->get_help_id = $match->getHelp->id;
		$timer->date_time_from = Carbon::now();
		$timer->more_time = 0;
		$timer->date_time_to = Carbon::now()->addHour(Setting::first()->allowed_payment_hours);
		$timer->save();
		
		$user = User::find($match->getHelp->user_id);
		$user->notify((new PartnerApprove($user))->delay(Carbon::now()->addMinute(10)));
		flash("you have successfully uploaded the a payment proof, your partner have been informed to approve this payment if correct, you can call to quicken the process", 'success');
		return redirect()->back();
	}
	
	public function confirm($id)
	{
		$match = Match::findOrFail($id);
		$match->status = 'confirmed';
		$match->updated_by = auth()->user()->id;
		$match->update();
		
		$provideHelp = ProvideHelp::find($match->provide_help_id);
		$provideHelp->status = 'done';
		$provideHelp->updated_by = auth()->user()->id;
		$provideHelp->update();
		
		$getHelp = GetHelp::find($match->get_help_id);
		$getHelp->status = 'done';
		$getHelp->amount_received = $getHelp->amount;
		$getHelp->updated_by = auth()->user()->id;
		$getHelp->update();
		
		
		$growth = new ClientCycleGrowth();
		$growth->provide_help_id = $provideHelp->id;
		$growth->total_growth = 1;
		$growth->next_growth = Carbon::now()->addDay(1);
		$growth->amount_grown = $provideHelp->amount;
		$growth->maturity_date = Carbon::now()->addDay(Setting::first()->maturity_days);
		$growth->maturity_days = Setting::first()->maturity_days;
		$growth->user_id = $provideHelp->user->id;
		$growth->percentage = CycleGrowth::where('amount', '<', $provideHelp->amount)->first()->percentage;
		$growth->save();
		
		$clientReferral = ClientReferral::where('user_id', auth()->user()->Referrer->user_id);
		
		$userReferralBonus = new UserReferralBonus();
		$userReferralBonus->referred = auth()->user()->id;
		$userReferralBonus->user_id = auth()->user()->Referrer->user_id;
		$userReferralBonus->status = "pending";
		$userReferralBonus->amoouunt = round((ReferralBonus::where('referral_count', '<', $clientReferral->count())->first()->percentage * $provideHelp->amount) / 100);
		$userReferralBonus->save();
		
		
		flash("Payment successfully confirmed", 'success');
		return redirect()->back();
	}
	
	public function addHour($id)
	{
		$match = Match::findOrFail($id);
		$timer = Timer::find($match->provideHelp->timer->id);
		$timer->more_time = $timer->more_time + 1;
		$timer->update();
		flash('You have successfully added one more hour grace to you partner', 'info');
		return redirect()->back();
	}
	
	public function withdraw($id)
	{
		$cycle = ClientCycleGrowth::find($id);
		$provideHelp = ProvideHelp::find($cycle->provideHelp->id);
		$provideHelp->status = 'withdrawn';
		$provideHelp->update();
		
		$mywallet = new MyWallet();
		$mywallet->amount = $cycle->amount_grown;
		$mywallet->user_id = auth()->user()->id;
		$mywallet->purpose = "Growth value";
		$mywallet->state = 'in';
		$mywallet->save();
		
		flash("You have successfully transferred your money to your wallet and you are ready to withdraw", 'success');
		return redirect()->back();
	}
}