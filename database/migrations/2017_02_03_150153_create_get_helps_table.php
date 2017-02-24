<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGetHelpsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('get_helps', function (Blueprint $table) {
			$table->increments('id');
			$table->double('amount');
			$table->double('amount_received')->default(0.0);
			
			$table->enum('status', ['done', 'cancelled', 'waiting', 'progress','incomplete'])->default('waiting');
			
			$table->boolean('matched')->default(0);
			
			$table->integer('user_id')->unsigned();
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
			
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
		Schema::dropIfExists('get_helps');
	}
}
