<?php

use App\Bank;
use App\User;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$bank = new Bank();
		$bank->name = 'First Bank';
		$bank->created_by = User::first()->id;
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Union Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Guaranty Trust Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'United Bank of Africa';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Fidelity Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Diamond Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Skye Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Keystone Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Wema Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'First City Monument Bank';
		$bank->save();
		
		$bank = new Bank();
		$bank->created_by = User::first()->id;
		$bank->name = 'Ecobank Bank';
		$bank->save();
	}
}