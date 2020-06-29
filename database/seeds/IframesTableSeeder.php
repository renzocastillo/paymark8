<?php

use Illuminate\Database\Seeder;

class IframesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('iframes')->delete();
        
        \DB::table('iframes')->insert(array (
            0 => 
            array (
                'id' => 28,
                'title' => '¿CÓMO RETIRO MIS COMISIONES ?',
                'html' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/y2nDWSZtQos" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'created_at' => '2019-11-05 00:13:08',
                'tipos_de_iframe_id' => 1,
                'enterprise_id' => NULL,
            ),
            1 => 
            array (
                'id' => 31,
                'title' => '¿COMO CREAR MI CUENTA PAYPAL ?',
                'html' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/7uBvdQGI6Vo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
                'created_at' => '2019-11-06 15:49:04',
                'tipos_de_iframe_id' => 1,
                'enterprise_id' => NULL,
            ),
        ));
        
        
    }
}