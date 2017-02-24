<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientCycleGrowth extends Model
{
	public function provideHelp()
	{
		return $this->belongsTo(ProvideHelp::class);
	}
}
