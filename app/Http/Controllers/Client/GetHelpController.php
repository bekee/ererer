<?php

namespace App\Http\Controllers\Client;

use App\GetHelp;
use App\Http\Controllers\Controller;
use App\Http\Requests\GetHelpRequest;
use App\MyWallet;
use App\ProvideHelp;


class GetHelpController extends Controller
{
	public function index()
	{
		$unmatcheds = GetHelp::where('user_id', auth()->user()->id)
			->where('status', 'waiting')
			->paginate(25);
		
		
		$matches = GetHelp::where('user_id', auth()->user()->id)
			->where('matched', true)
			->where('matching_status','incomplete')
			->where('published_set','yes')
			->paginate(25);
		$completeds = GetHelp::where('user_id', auth()->user()->id)->where('matched', true)->where('status', 'done')->paginate(25);
		$cancelleds = GetHelp::where('user_id', auth()->user()->id)->where('matched', true)->where('status', 'cancelled')->paginate(25);
		
		return view('client.get_help.index', compact('unmatcheds', 'matches', 'completeds', 'cancelleds'));
	}
	
	
	public function getHelp(GetHelpRequest $request)
	{
		$provide = ProvideHelp::where('user_id', auth()->user()->id)->first();
		
		if (empty($provide)) {
			flash("You have not provided any help", 'danger');
			return redirect()->back();
		} else {
			$provide = ProvideHelp::where('user_id', auth()->user()->id)->where('status', 'waiting')->first();
			if (empty($provide)) {
				flash("You must provide another help before you get HELP", 'danger');
				return redirect()->back();
			}
		}
		
		$wallet = MyWallet::where('user_id', auth()->user()->id)->get();
		//dd($wallet->sum('amount'));
		if ($wallet->sum('amount') >= $request->getHelp) {
			
			$getHelp = new GetHelp();
			$getHelp->amount = $request->getHelp;
			$getHelp->user_id = auth()->user()->id;
			$getHelp->created_by = auth()->user()->id;
			$getHelp->save();
			
			$mywallet = new MyWallet();
			$mywallet->amount = $request->getHelp * (-1);
			$mywallet->user_id = auth()->user()->id;
			$mywallet->purpose = "Get help of $request->getHelp";
			$mywallet->state = 'out';
			$mywallet->save();
			
			flash("You have successfully requested for HELP of " . env('CURRENCY_SYMBOL') . " " . number_format($getHelp->amount, 2), 'success');
			return redirect('dashboard/get_help');
		}
		
		flash('Sorry you do not have sufficient balance to request get HELP', 'danger');
		return redirect()->back();
	}
}
