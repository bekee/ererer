<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$this->call(PermissionSeeder::class);
		$this->call(RoleSeeder::class);
		$this->call(UserSeeder::class);
		$this->call(BankSeeder::class);
		$this->call(BonuseSetupSeeder::class);
		$this->call(OtherSettingSeeder::class);
	}
}
