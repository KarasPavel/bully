<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventHallTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_hall', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->index('event_id_2');
			$table->integer('hall_id')->index('hall_id_2');
			$table->string('is_delete')->default('false');
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
		Schema::drop('event_hall');
	}

}
