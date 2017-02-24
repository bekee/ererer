<?php

namespace App\Http\Controllers\Admin;

use App\ClientDetail;
use App\Http\Controllers\Controller;
use App\User;

class ClientController extends Controller
{
	public function active()
	{
		$actives = User::where('account', 'active')->first();
		return $actives;
		
		return view('admin.client.active', compact('actives'));
	}
}
