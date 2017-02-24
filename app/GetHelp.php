<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GetHelp extends Model
{
	public function user()
	{
		return $this->belongsTo(User::class);
	}
	
	public function timer()
	{
		return $this->hasOne(Timer::class);
	}
	
	public function matchedList()
	{
		return $this->hasMany(Match::class,'get_help_id');
	}
}
