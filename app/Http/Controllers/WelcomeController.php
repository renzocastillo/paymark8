<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;
use Session;

//use Request;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class WelcomeController extends Controller
{
    public function getview($user = null)
    {
        if (isset($user)) {
            $patrocinador = DB::table('cms_users')->where('slug', $user)->first();
        }
        $empresas = DB::table('empresas')->get();
        $anuncios = DB::table('anuncios')->where('publico',1)->get();
        $video = DB::table('videos')->latest()->first();
        $data = array(
            "empresas" => $empresas,
            "anuncios" => $anuncios,
            "video" => $video,
            "patrocinador" => $patrocinador
        );

        $countries = DB::table('countries')->orderBy('name')->get();
        View::share('countries', $countries);
        return view('welcome', $data);
    }

    public function addReproduccion($user = null, Request $request)
    {
        if (isset($user)) {
            $video_id = $request->video_id;
            $patrocinador = DB::table('cms_users')->where('slug', $user)->where('estado', 1)->first();
            $ipaddress = ip2long($request->ip());
            $reproduccion = DB::table('reproducciones')->where('cms_users_id', $patrocinador->id)->where('videos_id', $video_id)->where('ipaddress', $ipaddress)->exists();
            if (!$reproduccion) {
                if (!empty($patrocinador)) {
                    DB::table('reproducciones')
                        ->insert([
                            'cms_users_id' => $patrocinador->id,
                            'videos_id' => $video_id,
                            'ipaddress' => $ipaddress,
                            'created_at' => now()
                        ]);
                    //ahora aumentamos la cantidad de vistas actuales del usuario en uno
                    DB::table('cms_users')
                        ->where('id', $patrocinador->id)
                        ->increment('vistas_actuales', 1);
                    return response()->json(['success' => 'Se agregó una nueva reproduccion']);
                } else {
                    return response()->json(['success' => 'No existe este enlace de patrocinador o éste aún no está activado']);
                }
            } else {
                return response()->json(['success' => 'Ya se ha reproducido este video antes']);
            }
        }
    }
}
