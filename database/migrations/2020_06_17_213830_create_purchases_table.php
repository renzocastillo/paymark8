<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('purchases', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('fk_purchases_users_id');
			$table->decimal('amount', 10);
			$table->enum('status', array('pending','accepted','failed','insufficient_balance'))->default('pending');
			$table->string('eci_code')->nullable();
			$table->string('eci_description', 300)->nullable();
			$table->string('transaction_id')->nullable();
			$table->string('signature')->nullable();
			$table->string('transaction_invoice')->nullable();
			$table->dateTime('transaction_date')->nullable();
			$table->string('transaction_currency')->nullable();
			$table->decimal('transaction_amount', 10)->nullable();
			$table->string('card')->nullable();
			$table->string('action_description')->nullable();
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
		Schema::drop('purchases');
	}

}
