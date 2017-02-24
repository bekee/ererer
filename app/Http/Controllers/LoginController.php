<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function index()
	{
		if (Auth::check()) {
			return redirect(Auth::user()->route);
		}
		return view('login');
	}
	
	public function login(Request $request)
	{
		
		$this->validate($request,
			[
				'login-username' => 'required',
				'login-password' => 'required',
				//'g-recaptcha-response' => 'required|captcha'
			]
		);
		//dd(Auth::attempt(['email' => $request['login-username'], 'password' => $request['login-password'], 'account' => 'active'], $request['login-remember-me']));
		if (!Auth::attempt(['email' => $request['login-username'], 'password' => $request['login-password'], 'account' => 'active'], $request['login-remember-me'])) {
			flash("Invalid Email/Password", 'danger');
			return redirect()->back()->with(['fail' => 'Login unsuccessful'])->withInput();
		} else {
			if (Auth::user()->route == 'dashboard') {
				return redirect('dashboard');
			} elseif (Auth::user()->route == 'admin') {
				return redirect('admin');
			} else {
				flash("Invalid Email/Password ", 'danger');
				Auth::logout();
				return redirect('login')->with(['fail' => 'Login unsuccessful'])->withInput();
			}
		}
	}
	
	public function destroy()
	{
		Auth::logout();
		return redirect('/');
	}
}
