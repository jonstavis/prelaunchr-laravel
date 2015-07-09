<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->engine = 'InnoDB'; 

			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60)->nullable();
			$table->enum('role', [ 'USER', 'ADMIN' ])->default('USER');
			$table->string('referral_code', 60)->nullable();
			$table->string('referrer_code', 60)->nullable();
			$table->string('referral_secret', 60)->nullable();
			$table->string('confirmation_code', 60)->nullable();
			$table->integer('referrer_id')->unsigned()->nullable();
			$table->string('ip_address')->nullable();
			$table->boolean('valid_email')->default(false);
			$table->rememberToken();
			$table->timestamps();

			$table->foreign('referrer_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
