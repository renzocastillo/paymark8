<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIframesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('iframes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 45)->nullable();
			$table->string('html', 1000)->nullable();
			$table->timestamps();
			$table->integer('tipos_de_iframe_id')->unsigned();
			$table->integer('enterprise_id')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('iframes');
	}

}
