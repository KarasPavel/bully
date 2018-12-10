<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('kassir_id')->nullable();
			$table->integer('userId')->nullable();
			$table->string('title');
			$table->text('description', 65535)->nullable();
			$table->string('address')->nullable();
			$table->date('dateStart')->nullable();
			$table->time('timeStart')->nullable();
			$table->date('dateEnd')->nullable();
			$table->time('timeEnd')->nullable();
			$table->string('eventImage')->nullable();
			$table->integer('chekinRadius')->nullable();
			$table->string('ageRestrictions')->nullable();
			$table->string('entry')->nullable();
			$table->string('coverTitle');
			$table->string('coverImage');
			$table->string('is_delete')->default('false');
			$table->integer('action')->nullable();
			$table->integer('venue')->nullable();
			$table->string('url')->nullable();
			$table->integer('price_min')->nullable();
			$table->integer('price_max')->nullable();
			$table->integer('eticket')->nullable();
			$table->integer('selled_tickets')->nullable();
			$table->integer('core_id')->nullable();
			$table->string('special')->nullable();
			$table->string('special_tip')->nullable();
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
		Schema::drop('events');
	}

}
