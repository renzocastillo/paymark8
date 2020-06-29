<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->foreign('enterprise_id', 'fk_products_enterprise_id')->references('id')->on('empresas')->onUpdate('NO ACTION')->onDelete('cascade');
			$table->foreign('product_type_id', 'fk_products_product_types_id')->references('id')->on('product_types')->onUpdate('NO ACTION')->onDelete('cascade');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('products', function(Blueprint $table)
		{
			$table->dropForeign('fk_products_enterprise_id');
			$table->dropForeign('fk_products_product_types_id');
		});
	}

}
