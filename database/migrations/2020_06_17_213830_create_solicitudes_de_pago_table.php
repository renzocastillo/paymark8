<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSolicitudesDePagoTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('solicitudes_de_pago', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('monto')->nullable()->default(0);
			$table->integer('vistas')->nullable()->default(0);
			$table->integer('afiliados')->nullable()->default(0);
			$table->integer('nietos')->nullable()->default(0);
			$table->timestamps();
			$table->integer('cms_users_id')->unsigned();
			$table->integer('estados_id')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('solicitudes_de_pago');
	}

}
