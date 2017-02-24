<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('matches', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('get_help_id')->unsigned()->nullable();
			$table->integer('provide_help_id')->unsigned()->nullable();
			$table->enum('status', ['confirmed', 'cancelled', 'waiting'])->default('waiting');
			$table->text('proof')->nullable();
			$table->time('dead_line')->nullable();
			$table->enum('action_check', ['save', 'published'])->default('published');
			
			$table->integer('created_by')->unsigned()->nullable();
			$table->integer('updated_by')->unsigned()->nullable();
			$table->timestamps();
			
			$table->foreign('get_help_id')->references('id')->on('get_helps')->onDelete('cascade');
			$table->foreign('provide_help_id')->references('id')->on('provide_helps')->onDelete('cascade');
			
			$table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
			$table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('matches');
	}
}
