<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToCmsUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('cms_users', function(Blueprint $table)
		{
			$table->foreign('country_id')->references('id')->on('countries')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('cms_users_id')->references('id')->on('cms_users')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('cms_users', function(Blueprint $table)
		{
			$table->dropForeign('fk_cms_users_country_id');
			$table->dropForeign('fk_cms_users_cms_users');
		});
	}

}
