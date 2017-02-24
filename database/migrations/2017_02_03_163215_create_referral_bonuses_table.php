<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralBonusesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('referral_bonuses', function (Blueprint $table) {
			$table->increments('id');
			$table->double('amount')->nullable();
			$table->integer('referral_count')->nullable();//1-15, 16-30, etc...
			$table->double('percentage')->default(0.0);
			$table->enum('user_type', ['first-time', 'referral'])->default('first-time');
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
		Schema::dropIfExists('referral_bonuses');
	}
}
