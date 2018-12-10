<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSectorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sectors', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('hall_id');
			$table->string('name');
			$table->string('color');
			$table->integer('price');
			$table->integer('rows');
			$table->integer('cols');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sectors');
	}

}
