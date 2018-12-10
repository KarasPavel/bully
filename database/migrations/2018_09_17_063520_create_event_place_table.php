<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventPlaceTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_place', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->index('event_id');
			$table->integer('place_id')->index('place_id');
			$table->string('status')->default('free');
			$table->string('is_delete')->default('false');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_place');
	}

}
