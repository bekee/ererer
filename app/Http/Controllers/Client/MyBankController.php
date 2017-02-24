<?php

namespace App\Http\Controllers\Client;

use App\Bank;
use App\ClientBank;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyBankRequest;

class MyBankController extends Controller
{
	public function index()
	{
		$banks = Bank::pluck('name', 'id');
		$bank = ClientBank::where('user_id', auth()->user()->id)->first();
		return view('client.bank.index', compact('bank', 'banks'));
	}
	
	public function add(MyBankRequest $request)
	{
		$bank = new ClientBank();
		$bank->acc_name = $request->acc_name;
		$bank->acc_number = $request->acc_number;
		$bank->bank_id = $request->bank_id;
		$bank->user_id = auth()->user()->id;
		$bank->updated_by = auth()->user()->id;
		$bank->created_by = auth()->user()->id;
		$bank->save();
		
		flash('You have successfully added your bank', 'success');
		return redirect('dashboard');
	}
}
