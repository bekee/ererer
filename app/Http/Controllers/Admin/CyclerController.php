<?php

namespace App\Http\Controllers\Admin;

use App\CycleGrowth;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminCyclerRequest;

class CyclerController extends Controller
{
	public function index()
	{
		$cyclers = CycleGrowth::paginate(100);
		return view('admin.cycle.index', compact('cyclers'));
	}
	
	/**
	 * @param AdminCyclerRequest $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function newCycle(AdminCyclerRequest $request)
	{
		$cycle_growth = new CycleGrowth();
		$cycle_growth->amount = $request->amount;
		$cycle_growth->percentage = $request->percentage;
		$cycle_growth->days = $request->days;
		$cycle_growth->save();
		flash("New Cycler have been added");
		return redirect()->back();
	}
	
	public function update($id, AdminCyclerRequest $request)
	{
		$cycle_growth = CycleGrowth::findOrFail($id);
		$cycle_growth->amount = $request->amount;
		$cycle_growth->percentage = $request->percentage;
		$cycle_growth->days = $request->days;
		$cycle_growth->save();
		flash("Cycler have been updated");
		return redirect('admin/cycler');
	}
	
	public function edit($id)
	{
		$cycler = CycleGrowth::findOrFail($id);
		$cyclers = CycleGrowth::paginate(100);
		return view('admin.cycle.edit', compact('cyclers', 'cycler'));
	}
}
