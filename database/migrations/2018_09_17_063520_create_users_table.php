<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
			$table->integer('id', true);
			$table->string('firstName');
			$table->string('lastName')->nullable();
			$table->string('email')->nullable();
			$table->string('password')->nullable();
			$table->string('remember_token', 100)->nullable();
			$table->string('photo')->nullable();
			$table->string('phone')->nullable();
			$table->string('type', 20)->default('default');
			$table->timestamps();
			$table->string('google_id')->nullable();
			$table->string('avatar_original')->nullable();
			$table->string('vk_id')->nullable();
			$table->string('fb_id')->nullable();
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
