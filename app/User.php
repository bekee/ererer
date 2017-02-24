<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
	use LaratrustUserTrait;
	use Notifiable;
	
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name', 'email', 'password',
	];
	
	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password', 'remember_token',
	];
	
	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasOne
	 */
	public function client()
	{
		return $this->hasOne(ClientDetail::class);
	}
	
	public function admin()
	{
		return $this->hasOne(Admin::class);
	}
	
	public function provideHelp()
	{
		return $this->hasMany(ProvideHelp::class);
	}
	
	public function getHelp()
	{
		return $this->hasMany(GetHelp::class);
	}
	
	public function Referred()
	{
		return $this->hasOne(ClientReferral::class, 'referred');
	}
	
	public function Referrer()
	{
		return $this->hasOne(ClientReferral::class, 'user_id');
	}
	
	public function getReferral()
	{
		return $this->hasMany(ClientReferral::class, 'user_id');
	}
	
	
	public function myWallet()
	{
		return $this->hasMany(MyWallet::class);
	}
	
	public function ClientBank()
	{
		return $this->hasOne(ClientBank::class);
	}
	
	public function ChangeBank()
	{
		return $this->hasOne(ChangeBank::class);
	}
	
	
	public function allProvideHelp()
	{
		return ProvideHelp::sum('amount');
	}
	
	public function allGetHelp()
	{
		return GetHelp::sum('amount');
	}
	
	public function allFirstTimeBonus()
	{
		return FirstTimeBonus::sum('amount_gained');
	}
	
	public function allRefBonus()
	{
		return UserReferralBonus::sum('amount');
	}
}
