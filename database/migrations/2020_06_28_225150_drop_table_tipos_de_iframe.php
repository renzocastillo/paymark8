<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropTableTiposDeIframe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::drop('tipos_de_iframe');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('tipos_de_iframe', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('nombre', 45)->nullable();
			$table->string('slug', 45)->nullable();
		});
    }
}
