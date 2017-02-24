<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
	public function getHelp()
	{
		return $this->belongsTo(GetHelp::class, 'get_help_id');
	}
	
	public function provideHelp()
	{
		return $this->belongsTo(ProvideHelp::class);
	}
	
	public function MatchedTransaction()
	{
		return $this->hasOne(MatchTransactionAmount::class);
	}
	
	public function mmm()
	{
		return $this->hasOne(MatchTransactionAmount::class,'match_id');
	}
}