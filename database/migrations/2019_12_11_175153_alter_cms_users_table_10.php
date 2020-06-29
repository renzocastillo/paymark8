<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCmsUsersTable10 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_users', function (Blueprint $table) {
            $table->dateTime('activated_at')->nullable();
			$table->string('email_paypal')->nullable();
			$table->boolean('estado')->nullable();
			$table->integer('vistas_actuales')->nullable()->default(0);
			$table->integer('afiliaciones_actuales')->nullable()->default(0);
			$table->integer('nietos_actuales')->nullable()->default(0);
			$table->string('whatsapp', 45)->nullable();
			$table->string('slug', 45)->nullable();
            $table->boolean('premium')->default(0);
            $table->integer('cms_users_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_users', function (Blueprint $table) {
            $table->dropColumn('country_id')->nullable();
        });
    }
}
