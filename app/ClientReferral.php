<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientReferral extends Model
{
	public function UserReferralBonus()
	{
		return $this->hasMany(UserReferralBonus::class);
	}
	
	public function referred()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	
	public function Ireferred()
	{
		return $this->belongsTo(User::class, 'referred');
	}
}
