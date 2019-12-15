<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterIframesTable11 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iframes', function (Blueprint $table) {
            $table->integer('enterprise_id')->nullable();
            $table->foreign('enterprise_id', 'fk_iframes_enterprise_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
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
            $table->dropForeign('fk_iframes_enterprise_id');
            $table->dropColumn('enterprise_id')->nullable();
        });
    }
}
