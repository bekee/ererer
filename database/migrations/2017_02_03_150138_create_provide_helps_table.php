<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvideHelpsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provide_helps', function (Blueprint $table) {
			$table->increments('id');
			$table->double('amount');
			$table->double('amount_paid')->default(0.0);
			
			$table->boolean('matched')->default(0);
			
			$table->dateTime('expected_match_date')->nullable();
			$table->enum('status', ['done', 'cancelled', 'waiting', 'progress', 'withdrawn','incomplete'])->default('waiting');
			$table->integer('user_id')->unsigned();
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
			
			$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
			
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
		Schema::dropIfExists('provide_helps');
	}
}
