<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProvideHelp extends Model
{
	public function matchedList()
	{
		return $this->hasMany(Match::class,'provide_help_id');
	}
	
	public function timer()
	{
		return $this->hasOne(Timer::class);
	}
	
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function cycle()
	{
		return $this->hasOne(ClientCycleGrowth::class);
	}
}


