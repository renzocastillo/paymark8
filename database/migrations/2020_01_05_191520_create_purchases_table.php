<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
	        $table->foreign( 'user_id', 'fk_purchases_users_id' )->references( 'id' )->on( 'cms_users' )->onUpdate( 'NO ACTION' )->onDelete( 'NO ACTION' );
	        $table->decimal('amount',10,2);
	        $table->enum('status',['pending','accepted','failed','insufficient_balance'])->default('pending');
	        $table->string('eci_code')->nullable();
	        $table->string('eci_description',300)->nullable();
	        $table->string('transaction_id')->nullable();
	        $table->string('signature')->nullable();
	        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table( 'purchases', function ( Blueprint $table ) {
		    $table->dropForeign( 'fk_purchases_users_id' );
	    } );
        Schema::dropIfExists('purchases');
    }
}
