<?php

namespace App\Jobs;

use App\Match;
use App\Notifications\GelpHelpMatched;
use App\Notifications\HaveBeenMatched;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendMatchMail implements ShouldQueue
{
	use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
	
	protected $Mymatch;
	protected $provideHelp;
	protected $getHelp;
	
	/**
	 * Create a new job instance.
	 *
	 * @return void
	 */
	public function __construct(Match $Mymatch,$provideHelp, $getHelp)
	{
		$this->Mymatch = $Mymatch;
	}
	
	/**
	 * Execute the job.
	 *
	 * @return void
	 */
	public function handle()
	{
	//	$when = Carbon::now()->addMinutes(6);
	//	$when2 = Carbon::now()->addMinutes(10);
		$userProvide = User::find($this->Mymatch->provideHelp->user_id);
		$userProvide->notify((new HaveBeenMatched($this->provideHelp, $this->getHelp)));
		
		$userGetHelp = User::find($this->Mymatch->getHelp->user_id);
		$userGetHelp->notify((new GelpHelpMatched($this->provideHelp, $this->getHelp)));
	}
}
