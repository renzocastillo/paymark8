<?php

use Illuminate\Database\Seeder;

class AnunciosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('anuncios')->delete();
        
        
        
    }
}