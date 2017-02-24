<?php

use Illuminate\Database\Seeder;

class Bank2Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    
	    

	    $bank = new Bank();
	    $bank->name = 'Access Bank';
	    $bank->created_by = User::first()->id;
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'Citibank';
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'Dynamic Standard Bank';
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'First City Monument Bank';
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'Unity Bank Plc';
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'Ecobank Nigeria';
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'Heritage Bank Plc';
	    $bank->save();
	
	    
	
	   
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'First City Monument Bank';
	    $bank->save();
	
	    $bank = new Bank();
	    $bank->created_by = User::first()->id;
	    $bank->name = 'First Bank of Nigeria';
	    $bank->save();
    }
}
