<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropProductTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function(Blueprint $table)
		{
            $table->dropForeign('fk_products_product_types_id');
            $table->dropColumn('product_type_id');
        });
        
        Schema::drop('product_types');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('product_types', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->timestamps();
        });
        
        Schema::table('products', function(Blueprint $table)
		{
            $table->integer('product_type_id')->unsigned();
            $table->foreign('product_type_id', 'fk_products_product_types_id')->references('id')->on('product_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }
}
