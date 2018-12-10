<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCinemasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cinemas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('kassir_id')->nullable();
			$table->string('name');
			$table->string('address')->nullable();
			$table->string('image')->nullable();
			$table->string('lat')->nullable();
			$table->string('lng')->nullable();
			$table->text('description', 65535)->nullable();
			$table->string('url')->nullable();
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
		Schema::drop('cinemas');
	}

}
