<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToReproduccionesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reproducciones', function(Blueprint $table)
		{
			$table->foreign('cms_users_id', 'fk_reproducciones_cms_users1')->references('id')->on('cms_users')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('videos_id', 'fk_reproducciones_videos1')->references('id')->on('videos')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reproducciones', function(Blueprint $table)
		{
			$table->dropForeign('fk_reproducciones_cms_users1');
			$table->dropForeign('fk_reproducciones_videos1');
		});
	}

}
