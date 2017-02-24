<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstTimeBonusesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('first_time_bonuses', function (Blueprint $table) {
			$table->increments('id');
			$table->double('amount_invested')->default(0.0);
			$table->double('amount_gained')->default(0.0);
			$table->integer('provide_help_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamps();
			
			$table->foreign('provide_help_id')->references('id')->on('provide_helps')->onDelete('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('first_time_bonuses');
	}
}
