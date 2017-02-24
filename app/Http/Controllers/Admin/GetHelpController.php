<?php

namespace App\Http\Controllers\Admin;

use App\GetHelp;
use App\Http\Controllers\Controller;

class GetHelpController extends Controller
{
	public function index()
	{
		$getHelps = GetHelp::orderby('created_at', 'desc')->paginate(150);
		return view('admin.get.index', compact('getHelps'));
	}
}
