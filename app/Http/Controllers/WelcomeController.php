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
        $video=DB::table('videos')->latest()->first(); 
        $data=array("empresas"=>$empresas,"anuncios"=>$anuncios,"video"=>$video); 
        return view('welcome',$data);
  }
}