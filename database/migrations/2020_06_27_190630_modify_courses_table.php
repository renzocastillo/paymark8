<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('value','description');
            $table->dropColumn('image');
            $table->string('author');
            $table->decimal('price','6'); 
            $table->tinyInteger('duration');     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->renameColumn('description','value');
            $table->string('image')->nullable();
            $table->dropColumn('author');
            $table->dropColumn('price');
            $table->dropColumn('duration');
        });
    }
}
