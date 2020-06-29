<?php

use Illuminate\Database\Seeder;

class TiposDeIframeTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tipos_de_iframe')->delete();
        
        \DB::table('tipos_de_iframe')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nombre' => 'Video de Youtube',
                'slug' => 'video',
            ),
            1 => 
            array (
                'id' => 2,
                'nombre' => 'Producto',
                'slug' => 'producto',
            ),
        ));
        
        
    }
}