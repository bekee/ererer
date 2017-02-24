<?php

namespace App\Http\Controllers\Client;

use App\ClientCycleGrowth;
use App\FirstTimeBonus;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProvideHelpRequest;
use App\ProvideHelp;
use App\ReferralBonus;
use App\Setting;
use App\User;
use Carbon\Carbon;

class ProvideHelpController extends Controller
{
	public function index()
	{
		$unmatcheds = ProvideHelp::where('user_id', auth()->user()->id)->where('status', 'waiting')->paginate(25);
		$cancelleds = ProvideHelp::where('user_id', auth()->user()->id)->where('matched', true)->where('status', 'cancelled')->paginate(25);
		
		
		$matches = ProvideHelp::where('user_id', auth()->user()->id)->where('matched', true)->where('status', 'waiting')->where('published_set', 'yes')->paginate(25);
		$cycles = ProvideHelp::where('user_id', auth()->user()->id)->where('matched', true)->where('status', 'done')->paginate(25);
		
		$growths = ClientCycleGrowth::where('user_id', auth()->user()->id)->orderby('created_at', 'desc')->paginate(25);
		
		return view('client.provide_help.index', compact('unmatcheds', 'matches', 'cycles', 'cancelleds', 'growths'));
	}
	
	public function provideHelp(ProvideHelpRequest $request)
	{
		$provide = ProvideHelp::where('user_id', auth()->user()->id)->first();
		
		if (auth()->user()->first_time_bonus == 1) {
			if ($request->provideHelp < $provide->amount) {
				flash("Sorry you cannot provide help less than your last provide help of " . env('CURRENCY_SYMBOL') . " " . number_format($provide->amount, 2), 'danger');
				return redirect()->back();
			}
		}
		$providehelp = new  ProvideHelp();
		$providehelp->amount = $request->provideHelp;
		$providehelp->expected_match_date = Carbon::now()->addDay(Setting::first()->expected_matching_days);
		$providehelp->user_id = auth()->user()->id;
		$providehelp->created_by = auth()->user()->id;;
		$providehelp->updated_by = auth()->user()->id;;
		$providehelp->save();
		
		if (auth()->user()->first_time_bonus == 0) {
			$firstTimeBonus = new FirstTimeBonus();
			$firstTimeBonus->amount_invested = $providehelp->amount;
			$firstTimeBonus->amount_gained = (($this->getRateFirstTime($providehelp->amount) / 100) * $providehelp->amount);
			$firstTimeBonus->provide_help_id = $providehelp->id;
			$firstTimeBonus->user_id = auth()->user()->id;
			$firstTimeBonus->save();
			
			$user = User::find(auth()->user()->id);
			$user->first_time_bonus = 1;
			$user->update();
		}
		
		flash("You have successfully pledged to provide help of " . env('CURRENCY_SYMBOL') . " " . number_format($providehelp->amount, 2), 'success');
		return redirect('dashboard/provide_help');
	}
	
	public function getRateFirstTime($amount)
	{
		$bonus = ReferralBonus::where('user_type', 'first-time')->where('amount', '<=', $amount)->orderby('amount', 'asc')->first();
		return $bonus->percentage;
	}
}
