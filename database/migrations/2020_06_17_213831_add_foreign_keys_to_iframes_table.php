<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIframesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('iframes', function(Blueprint $table)
		{
			$table->foreign('enterprise_id', 'fk_iframes_enterprise_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('tipos_de_iframe_id', 'fk_iframes_tipos_de_iframe1')->references('id')->on('tipos_de_iframe')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('iframes', function(Blueprint $table)
		{
			$table->dropForeign('fk_iframes_enterprise_id');
			$table->dropForeign('fk_iframes_tipos_de_iframe1');
		});
	}

}
