<?php

namespace App\Http\Controllers;

use Session;
use Request;
use DB;
use CRUDBooster;

class WelcomeController extends Controller
{
  public function getview($user=null) {
      if(isset($user)){
        $patrocinador= DB::table('cms_users')->where('slug',$user)->first();
      }
        $empresas=DB::table('empresas')->get();
        $anuncios=DB::table('anuncios')->get(); 
        $video=DB::table('videos')->latest()->first(); 
        $data=array("empresas"=>$empresas,"anuncios"=>$anuncios,"video"=>$video,"patrocinador"=>$patrocinador); 
        return view('welcome',$data);
  }
}