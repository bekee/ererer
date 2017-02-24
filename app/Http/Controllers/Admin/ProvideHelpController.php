<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\ProvideHelp;

class ProvideHelpController extends Controller
{
	public function index()
	{
		$provideHelps = ProvideHelp::orderby('created_at', 'desc')->paginate(150);
		return view('admin.provide.index', compact('provideHelps'));
	}
}
