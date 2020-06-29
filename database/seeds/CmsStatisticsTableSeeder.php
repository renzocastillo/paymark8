<?php

use Illuminate\Database\Seeder;

class CmsStatisticsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('cms_statistics')->delete();
        
        \DB::table('cms_statistics')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Gráfica oficina',
                'slug' => 'grafica-oficina',
                'created_at' => '2019-09-20 15:44:54',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}