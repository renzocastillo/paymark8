<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'products', function ( Blueprint $table ) {
			$table->increments( 'id' );
			$table->string('title');
			$table->text( 'value' );
			$table->integer( 'product_type_id' )->unsigned();
			$table->integer( 'enterprise_id' );
			$table->foreign( 'enterprise_id', 'fk_products_enterprise_id' )->references( 'id' )->on( 'empresas' )->onUpdate( 'NO ACTION' )->onDelete( 'NO ACTION' );
			$table->foreign( 'product_type_id', 'fk_products_product_types_id' )->references( 'id' )->on( 'product_types' )->onUpdate( 'NO ACTION' )->onDelete( 'NO ACTION' );
			$table->timestamps();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table( 'products', function ( Blueprint $table ) {
			$table->dropForeign( 'fk_products_enterprise_id' );
			$table->dropForeign( 'fk_products_product_types_id' );
		} );
		Schema::dropIfExists( 'products' );
	}
}
