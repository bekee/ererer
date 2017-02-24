<?php

namespace App\Http\Controllers\Admin;

use App\Bank;
use App\Http\Controllers\Controller;
use App\Http\Requests\BankRequest;

class BankController extends Controller
{
	public function index()
	{
		$banks = Bank::paginate(100);
		return view('admin.banks.index', compact('banks'));
	}
	
	/**
	 * @param BankRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function newBank(BankRequest $request)
	{
		$bank = new Bank();
		$bank->name = $request->bank;
		$bank->created_by = auth()->user()->id;
		$bank->updated_by = auth()->user()->id;
		$bank->save();
		flash("Bank $bank->name was successfully added", 'success');
		return redirect()->back();
	}
	
	public function edit($id)
	{
		$banks = Bank::paginate(100);
		$bank = Bank::findOrFail($id);
		return view('admin.banks.edit', compact('banks', 'bank'));
	}
	
	public function update($id, BankRequest $request)
	{
		$bank = Bank::findOrFail($id);
		$bank->name = $request->bank;
		$bank->created_by = auth()->user()->id;
		$bank->updated_by = auth()->user()->id;
		$bank->save();
		flash("Bank $bank->name was successfully updated", 'success');
		return redirect('admin/banks');
	}
}
