<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysToModulesRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('module_videos', function (Blueprint $table) {
            $table->foreign('modules_id')->references('id')->on('modules')->onDelete('cascade');
        });

        Schema::table('module_files', function (Blueprint $table) {
            $table->foreign('modules_id')->references('id')->on('modules')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('module_videos', function (Blueprint $table) {
            $table->dropForeign('module_videos_modules_id_foreign');
        });

        Schema::table('module_files', function (Blueprint $table) {
            $table->dropForeign('module_files_modules_id_foreign');
        });
    }
}
