<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('timers', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('provide_help_id')->unsigned()->nullable();
			$table->integer('get_help_id')->unsigned()->nullable();
			$table->dateTime('date_time_from')->nullable();
			$table->dateTime('date_time_to')->nullable();
			$table->integer('more_time')->nullable();
			$table->timestamps();
			$table->foreign('provide_help_id')->references('id')->on('provide_helps')->onDelete('cascade');
			$table->foreign('get_help_id')->references('id')->on('get_helps')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('timers');
	}
}
