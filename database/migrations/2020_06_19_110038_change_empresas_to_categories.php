<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeEmpresasToCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iframes', function(Blueprint $table)
		{
            $table->dropForeign('fk_iframes_enterprise_id');
            $table->dropColumn('enterprise_id');
        });

        Schema::table('products', function(Blueprint $table)
		{
            $table->dropForeign('fk_products_enterprise_id');
            $table->dropColumn('enterprise_id');
        });

        Schema::rename('empresas', 'categories');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('categories', 'empresas');

        Schema::table('iframes', function(Blueprint $table)
		{
            $table->integer('enterprise_id')->unsigned()->nullable();
            $table->foreign('enterprise_id', 'fk_iframes_enterprise_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

        Schema::table('products', function(Blueprint $table)
		{
            $table->integer('enterprise_id')->unsigned();
            $table->foreign('enterprise_id', 'fk_products_enterprise_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });

    }
}
