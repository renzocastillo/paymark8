<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropForeignKeyTiposDeIframeFromIframesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iframes', function (Blueprint $table) {
            $table->dropForeign('fk_iframes_tipos_de_iframe1');
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
            $table->foreign('tipos_de_iframe_id', 'fk_iframes_tipos_de_iframe1')->references('id')->on('tipos_de_iframe')->onUpdate('NO ACTION')->onDelete('cascade');
        });
    }
}
