<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tickets', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('order_id');
			$table->string('guid');
			$table->string('event_name');
			$table->string('event_image');
			$table->string('address');
			$table->string('date');
			$table->string('time');
			$table->integer('price');
			$table->integer('row');
			$table->integer('place');
			$table->integer('sector_id');
			$table->integer('event_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tickets');
	}

}
