<?php

use Illuminate\Database\Seeder;

class ParametrosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('parametros')->delete();
        
        \DB::table('parametros')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'gvista',
                'content' => '2',
                'helper' => 'Es la ganancia por cada reproducción en el link del afiliado',
                'created_at' => NULL,
                'label' => 'Ganancia por vista',
                'content_input_type' => 'text',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'gafiliacion',
                'content' => '20',
                'helper' => 'Es la ganancia por cada afiliación a través del link del afiliado',
                'created_at' => NULL,
                'label' => 'Ganancia por afiliación',
                'content_input_type' => 'text',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'pmin',
                'content' => '20',
                'helper' => 'Es el monto mínimo para solicitar un depósito',
                'created_at' => NULL,
                'label' => 'Monto mínimo de solicitud de pago',
                'content_input_type' => 'text',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'cvhijo',
                'content' => '10',
                'helper' => 'Es el incremento en capacidad de vistas que se otorga a un linker si tiene afiliado un nuevo hijo',
                'created_at' => NULL,
                'label' => 'Capacidad de vistas por hijo',
                'content_input_type' => 'text',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'cvnieto',
                'content' => '10',
                'helper' => 'Es el incremento en capacidad de vistas que se otorga a un linker si tiene afiliado un nuevo nieto',
                'created_at' => NULL,
                'label' => 'Capacidad de vistas por nieto',
                'content_input_type' => 'text',
            ),
        ));
        
        
    }
}