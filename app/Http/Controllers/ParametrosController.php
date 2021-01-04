<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ParametrosController extends Controller
{
    public function getGananciaPorVista()
    {
        return DB::table('parametros')->where('name', 'gvista')->value('content');
    }

    public function getGananciaporAfiliacion()
    {
        return DB::table('parametros')->where('name', 'gafiliacion')->value('content');
    }

    public function getPagoMinimo()
    {
        return DB::table('parametros')->where('name', 'pmin')->value('content');
    }
    
    public function getCapacidadDeVistasPorNieto()
    {
        return DB::table('parametros')->where('name', 'cvnieto')->value('content');
    }

    public function getCapacidadDeVistasPorHijo()
    {
        return DB::table('parametros')->where('name', 'cvhijo')->value('content');
    }
    
 
    
    public function getPercentageCurso()
    {
        return DB::table('parametros')->where('name', 'pcurso')->value('content');
    }
}
