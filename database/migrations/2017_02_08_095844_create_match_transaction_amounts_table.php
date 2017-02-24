<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchTransactionAmountsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('match_transaction_amounts', function (Blueprint $table) {
			$table->increments('id');
			$table->double('matched_amount')->default(0.0);
			$table->double('amount_transferred')->default(0.0)->nullable();
			$table->integer('match_id')->unsigned();
			$table->timestamps();
			$table->foreign('match_id')->references('id')->on('matches')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('match_transaction_amounts');
	}
}
