<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
	    DB::table('product_types')->delete();
	    $types = array(
		    [
			    'id' => 1,
			    'name' => 'Link'
		    ],
		    [
			    'id' => 2,
			    'name' => 'Iframe'
		    ]
	    );
	    DB::table('product_types')->insert($types);
    }
}
