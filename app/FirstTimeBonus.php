<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FirstTimeBonus extends Model
{
	public function provideHelp()
	{
		return $this->belongsTo(ProvideHelp::class);
	}
}
