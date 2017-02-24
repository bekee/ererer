<?php

namespace App\Http\Controllers\Client;

use App\GetHelp;
use App\Http\Controllers\Controller;
use App\ProvideHelp;

class DashboardController extends Controller
{
	public function index()
	{
		$gets = GetHelp::paginate(10);
		$provides = ProvideHelp::paginate(10);
		return view('client.index', compact('gets', 'provides'));
	}
}
