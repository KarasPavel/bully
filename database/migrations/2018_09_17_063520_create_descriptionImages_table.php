<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDescriptionImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('descriptionImages', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id');
			$table->string('image');
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
		Schema::drop('descriptionImages');
	}

}
