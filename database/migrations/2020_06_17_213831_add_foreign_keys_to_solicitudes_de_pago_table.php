<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class AddForeignKeysToSolicitudesDePagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('solicitudes_de_pago', function(Blueprint $table)
		{
			$table->foreign('cms_users_id', 'fk_solicitudes_de_pago_cms_users1')->references('id')->on('cms_users')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('estados_id', 'fk_solicitudes_de_pago_estados1')->references('id')->on('estados')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('solicitudes_de_pago', function(Blueprint $table)
		{
			$table->dropForeign('fk_solicitudes_de_pago_cms_users1');
			$table->dropForeign('fk_solicitudes_de_pago_estados1');
		});
	}

}
