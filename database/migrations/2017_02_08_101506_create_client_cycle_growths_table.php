<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientCycleGrowthsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('client_cycle_growths', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('provide_help_id')->unsigned()->nullable();
			$table->double('amount_grown')->default(0.0);
			$table->timestamps();
			
			$table->foreign('provide_help_id')->references('id')->on('provide_helps')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('client_cycle_growths');
	}
}
