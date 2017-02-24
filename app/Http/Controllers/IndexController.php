<?php

namespace App\Http\Controllers;

use App\ClientDetail;
use App\ClientReferral;
use App\Http\Requests\signupClientRefRequest;
use App\Http\Requests\signupClientRequest;
use App\MyWallet;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
	public function index()
	{
		return view('index');
	}
	
	public function login()
	{
		return view('login');
	}
	
	
	public function signup()
	{
		return view('signup');
	}
	
	public function signupClient(signupClientRequest $request)
	{
		if ($request->ref_email) {
			$ref_person = User::where('email', $request->ref_email)->first();
			if (!$ref_person) {
				flash("The referral email is wrong", 'danger');
				return redirect()->back();
			}
		}
		$code = $this->checkCode();
		
		$user = new User();
		$user->email = $request['register-email'];
		$user->password = bcrypt($request['password']);
		$user->route = 'dashboard';
		$user->phone = $request['register-mobile'];
		$user->save();
		
		$role = Role::where('name', 'client')->first();
		$user->attachRole($role);
		
		$detail = new ClientDetail();
		$detail->first_name = $request['register-first-name'];
		$detail->last_name = $request['register-last-name'];
		$detail->ref_code = $code;
		$detail->ref_url = url('/') . "/signup/$code";
		$detail->user_id = $user->id;
		$detail->created_by = $user->id;;
		$detail->updated_by = $user->id;
		$detail->save();
		
		$mywallet = new MyWallet();
		$mywallet->amount = 0;
		$mywallet->user_id = $user->id;
		$mywallet->purpose = "Initial Setup";
		$mywallet->state = 'in';
		$mywallet->save();
		
		if ($request->ref_email) {
			$ref_person = User::where('email', $request->ref_email)->first();
			if ($ref_person) {
				$referral = new ClientReferral();
				$referral->user_id = $ref_person->id;
				$referral->referred = $user->id;
				$referral->created_by = $user->id;;
				$referral->updated_by = $user->id;
				$referral->save();
			}
		}
		Auth::attempt(['email' => $request['register-email'], 'password' => $request['password'], 'account' => 'active']);
		
		return redirect('dashboard');
	}
	
	public function referral($code)
	{
		$userDetail = ClientDetail::where('ref_code', $code)->first();
		if (empty($userDetail)) {
			flash('Your referral code is either not in use or not available', 'danger');
			return redirect()->back();
		}
		$ref_code = $userDetail->ref_code;
		$ref_email = $userDetail->user->email;
		
		return view('referral', compact('ref_code', 'ref_email'));
	}
	
	public function signupReferral(signupClientRefRequest $request)
	{
		$code = $this->checkCode();
		
		$client_ref = ClientDetail::where('ref_code', $request->ref)->first();
		
		if (!$client_ref) {
			flash("We are unable to identify your referral link", 'danger');
			return redirect()->back();
		}
		
		$user = new User();
		$user->email = $request['register-email'];
		$user->password = bcrypt($request['password']);
		$user->route = 'dashboard';
		$user->phone = $request['register-mobile'];
		$user->save();
		
		$detail = new ClientDetail();
		$detail->first_name = $request['register-first-name'];
		$detail->last_name = $request['register-last-name'];
		$detail->ref_code = $code;
		$detail->ref_url = url('/') . "/signup/$code";
		$detail->user_id = $user->id;
		$detail->created_by = $user->id;;
		$detail->updated_by = $user->id;
		$detail->save();
		
		$referral = new ClientReferral();
		$referral->user_id = $request->ref;
		$referral->referred = $user->id;
		$referral->created_by = $user->id;;
		$referral->updated_by = $user->id;
		$referral->save();
		
		Auth::attempt(['email' => $request['register-email'], 'password' => $request['password'], 'account' => 'active']);
		
		return redirect('dashboard');
	}
	
	public function logout()
	{
		auth()->logout();
		return redirect('/');
	}
	
	private function checkCode($length = 15)
	{
		$code = str_random($length);
		$userDetail = ClientDetail::where('ref_code', $code)->first();
		if (empty($userDetail))
			return $code;
		else
			$this->checkCode();
	}
}
