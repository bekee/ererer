<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$permission = new Permission();
		$permission->name = 'create-admin';
		$permission->display_name = 'Create Admin Account'; // optional
		$permission->description = 'Create Admin Account'; // optional
		$permission->save();
		
		$permission = new Permission();
		$permission->name = 'create-account';
		$permission->display_name = 'Create User Account'; // optional
		$permission->description = 'Create User Account'; // optional
		$permission->save();
	}
}
