<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;

class ClientController extends Controller
{
	public function active()
	{
		$actives = User::where('account', 'active')->paginate(200);
		return view('admin.client.active', compact('actives'));
	}
}
