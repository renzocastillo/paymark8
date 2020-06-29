<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReproduccionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reproducciones', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('ipaddress')->unsigned()->nullable();
			$table->integer('cms_users_id')->unsigned();
			$table->integer('videos_id')->unsigned();
			$table->dateTime('created_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reproducciones');
	}

}
