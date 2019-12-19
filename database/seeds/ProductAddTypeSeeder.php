<?php

use Illuminate\Database\Seeder;

class ProductAddTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    $types=array(
		   'nombre' => 'link',
		    'slug' => 'link'
	    );
	    DB::table('tipos_de_iframe')->insert($types);
    }
}
