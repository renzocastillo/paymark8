<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

class WelcomeController extends Controller
{
  public function getview() {
        $empresas=DB::table('empresas')->get();
        $anuncios=DB::table('anuncios')->get(); 
        $data=array("empresas"=>$empresas,"anuncios"=>$anuncios); 
        return view('welcome',$data);
  }
}