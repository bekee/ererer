<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientBank extends Model
{
	public function bank()
	{
		return $this->belongsTo(Bank::class);
	}
}
