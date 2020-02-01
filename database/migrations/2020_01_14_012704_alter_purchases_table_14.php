<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPurchasesTable14 extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table( 'purchases', function ( Blueprint $table ) {
			$table->string( 'card' )->nullable();
			$table->string( 'action_description' )->nullable();
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table( 'purchases', function ( Blueprint $table ) {
			$table->dropColumn( 'card' );
			$table->dropColumn( 'action_description' );
		} );
	}
}
