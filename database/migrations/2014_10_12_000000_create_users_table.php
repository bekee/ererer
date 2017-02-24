<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('email')->unique();
			$table->string('route');
			$table->string('password');
			$table->boolean('email_confirm')->default(0);
			$table->boolean('first_time_bonus')->default(0);
			$table->string('phone')->unique();
			$table->enum('account', ['active', 'suspended', 'blocked'])->default('active');
			$table->rememberToken();
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
