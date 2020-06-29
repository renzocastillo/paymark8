<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnTiposDeIframeId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iframes', function (Blueprint $table) {
            $table->dropColumn('tipos_de_iframe_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iframes', function (Blueprint $table) {
            $table->integer('tipos_de_iframe_id')->unsigned();
        });
    }
}
