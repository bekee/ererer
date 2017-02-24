<?php

use App\Admin;
use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$user = new User();
		$user->email = 'frank4up@googlemail.com';
		$user->password = bcrypt('12345');
		$user->account = 'active';
		$user->route = 'admin';
		$user->phone = "+234908838586";
		$user->save();
		
		$role = Role::where('name', 'admin')->first();
		$user->attachRole($role);
		
		$admin = new Admin();
		$admin->first_name = 'Bekee';
		$admin->last_name = 'Franklin';
		$admin->user_id = $user->id;
		$admin->save();
	}
}
