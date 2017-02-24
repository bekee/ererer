<?php

namespace App\Http\Controllers\Admin;

use App\GetHelp;
use App\Http\Controllers\Controller;
use App\Jobs\SendMatchMail;
use App\Match;
use App\MatchTransactionAmount;
use App\ProvideHelp;
use App\Setting;
use App\Timer;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MatchesController extends Controller
{
	
	public function index()
	{
		$provideHelps = ProvideHelp::where('status', 'waiting')->orwhere('matched', false)->where('matching_status', 'incomplete')->paginate(50);
		//$getHelps = GetHelp::where('status', 'waiting')->where('matched', false)->orwhere('status', 'incomplete')->paginate(50);
		$getHelps = GetHelp::where('status', 'waiting')->orwhere('matched', true)->where('matching_status', 'incomplete')->paginate(25);
		
		//$saves = Match::join('provide_helps', 'matches.provide_help_id', '=', 'provide_helps.id')->where('matches.action_check', 'save')->paginate(200);
		//$saves = Match::where('action_check','=', 'save');
		//$collections = new Collection($saves);
		//$saves = $collections->groupBy('provide_help_id');
		
		//$saves = DB::table('matches')			->where('action_check', '=', "save")	->groupBy('provide_help_id')		->get();
		
		$saves = Match::where('action_check','=', 'save')->groupBy('provide_help_id')->paginate(200);
		
		//return dd($saves);
		
		return view('admin.matches.index', compact('provideHelps', 'getHelps', 'saves'));
	}
	
	public function matchMe($id)
	{
		$provideHelp = ProvideHelp::findOrFail($id);
		$getHelps = GetHelp::where('user_id', '!=', $provideHelp->user->id)
			->where('status', 'waiting')
			->orwhere('matched', false)
			->get();
		//	->paginate(50);
		$getHelps = new Collection($getHelps);
		$getHelps = $getHelps->filter(function ($item) use ($provideHelp) {
			return $item->user_id != $provideHelp->user->id;
		});
		
		$errored = [];
		$amounts = [];
		
		if (($getHelps->isEmpty())) {
			flash("There is no matching list", 'danger');
			return redirect()->back();
		}
		
		//$getHelps = $getHelps->forget($provideHelp->user_id);
		return view('admin.matches.match', compact('provideHelp', 'getHelps'));
	}
	
	public function match($id, Request $request)
	{
		
		
		$provideHelp = ProvideHelp::find($id);
		$errored = [];
		$amounts = [];
		$error = false;
		foreach ($request->id as $key => $idGetHelp) {
			$getHelp = GetHelp::find($idGetHelp);
			$msg = '';
			
			$amounts[$key] = $request->amount[$key];
			
			if ($request->amount[$key] > $getHelp->amount) {
				$error = true;
				$msg = 'Sorry you cannot give more than the requested amount';
			}
			
			
		}
		
		if ($error == true) {
			flash("Kindly cross check money assigned to some  get helps are higher than the expected", 'danger');
			return redirect()->back()->with(compact('errored'));
		}
		
		foreach ($request->id as $key => $idGetHelp) {
			if ($request->amount[$key] != 0) {
				$match = new Match();
				$match->matched_amount = $request->amount[$key];
				$match->amount_transferred = $request->amount[$key];
				$match->get_help_id = $idGetHelp;
				$match->provide_help_id = $id;
				$match->status = 'waiting';
				$match->action_check = 'save';
				$match->created_by = auth()->user()->id;
				$match->updated_by = auth()->user()->id;
				$match->save();
				
				$getHelp = GetHelp::find($idGetHelp);
				$getHelp->matched = true;
				$getHelp->amount_received = $getHelp->amount_received + $request->amount[$key];
				$getHelp->update();
				/*
				$matchedTransaction = new MatchTransactionAmount();
				$matchedTransaction->matched_amount = $getHelp->amount_received;
				$matchedTransaction->amount_transferred = $provideHelp->amount_paid;
				$matchedTransaction->match_id = $match->id;
				$matchedTransaction->save();
				*/
				$provideHelp->matched = true;
				$provideHelp->amount_paid = $provideHelp->amount_paid + $request->amount[$key];
				$provideHelp->update();
			}
		}
		
		
		return redirect('admin/matches');
	}
	
	public function publish()
	{
		$matches = Match::where('action_check', 'save')->get();
		
		foreach ($matches as $Mymatch) {
			$matchMe = Match::find($Mymatch->id);
			$matchMe->action_check = 'published';
			$matchMe->update();
			
			
			$provideHelp = ProvideHelp::find($matchMe->provideHelp->id);
			//$sumProvideHelp = 0;
			//$sumHelp = Match::where('provide_help_id', $provideHelp->id)->get();
			/*foreach ($sumHelp as $item) {
				$sumProvideHelp = $sumProvideHelp + $item->MatchedTransaction->matched_amount;
			}*/
			
		//	return $provideHelp->matchedList->sum('matched_amount');
				
			$provideHelp->matching_status = 'complete';
			if ($provideHelp->amount == $provideHelp->matchedList->sum('matched_amount')) {
				$provideHelp->status = 'progress';
				$provideHelp->matching_status = 'incomplete';
			}
			$provideHelp->published_set = 'yes';
			
			$provideHelp->update();
			
			$getHelp = GetHelp::find($matchMe->getHelp->id);
			
			//$sumGetHelp = 0;
			//$sumHelpP = Match::where('get_help_id', $getHelp->id)->get();
		/*	foreach ($sumHelpP as $item) {
				$sumGetHelp = $sumGetHelp + $item->MatchedTransaction->matched_amount;
			}
		*/
			$getHelp->matching_status = 'complete';
			if ($getHelp->amount == $getHelp->matchedList->sum('amount_transferred')) {
				$getHelp->status = 'progress';
				$getHelp->matching_status = 'incomplete';
			}
			$getHelp->published_set = 'yes';
			$getHelp->update();
			
			
			$timer = new Timer();
			$timer->provide_help_id = $provideHelp->id;
			$timer->date_time_from = Carbon::now();
			$timer->more_time = 0;
			$timer->date_time_to = Carbon::now()->addHour(Setting::first()->allowed_payment_hours);
			$timer->save();
			
			$when = Carbon::now()->addMinutes(2);
			dispatch((new SendMatchMail($Mymatch, $provideHelp, $getHelp))->onQueue('database'));
			/*
			$when = Carbon::now()->addMinutes(10);
			$when2 = Carbon::now()->addMinutes(12);
			$userProvide = User::find($Mymatch->provideHelp->user_id);
			$userProvide->notify((new HaveBeenMatched($provideHelp, $getHelp))->delay($when));
			
			$userGetHelp = User::find($Mymatch->getHelp->user_id);
			$userGetHelp->notify((new GelpHelpMatched($provideHelp, $getHelp))->delay($when2));
			*/
			return redirect()->back();
		}
	}
	
	public function clear()
	{
		$matches = Match::where('action_check', 'save')->get();
		foreach ($matches as $match) {
			$provideHelp = ProvideHelp::find($match->provide_help_id);
			$provideHelp->matched = true;
			$provideHelp->amount_paid = $provideHelp->amount_paid - $match->MatchedTransaction->matched_amount;
			$provideHelp->update();
			
			$getHelp = GetHelp::find($match->get_help_id);
			$getHelp->matched = true;
			$getHelp->amount_received = $getHelp->amount_received - $match->MatchedTransaction->matched_amount;
			$getHelp->update();
			
			$mm = Match::find($match->id);
			$mm->delete();
		}
		flash("You have successfully cleared the save matches", 'success');
		return redirect()->back();
	}
}
