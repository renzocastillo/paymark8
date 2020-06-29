<?php

use Illuminate\Database\Seeder;

class SolicitudesDePagoTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('solicitudes_de_pago')->delete();
        
        
        
    }
}