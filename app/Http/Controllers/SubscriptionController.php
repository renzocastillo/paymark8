<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use crocodicstudio\crudbooster\helpers\CRUDBooster;

class SubscriptionController extends Controller
{
    public function activateUser($id)
    {
        $user = DB::table('cms_users')
            ->where('id', $id)
            ->get()
            ->first();
        //evaluamos si el usuario está inactivo para según eso activarlo o no
        if (!$user->estado) {
            //activamos al usuario en la BD cambiándole su estado
            DB::table('cms_users')->where('id', $id)->update([
                'estado' => 1,
                'activated_at' => now()
            ]);
            //aumentamos la cantidad de afiliados actuales del patrocinador en 1
            if ($user->cms_users_id) {
                DB::table('cms_users')->where('id', $user->cms_users_id)->increment('afiliaciones_actuales', 1);
                $abuelo = $this->getAbuelo($user->cms_users_id);
                if (!empty($abuelo)) {
                    DB::table('cms_users')->where('id', $abuelo->id)->increment('nietos_actuales', 1);
                }
            }
            //mandamos un email a la cuenta de correo de este usuario
            $link = url('/' . $user->slug);
            $data = [
                'nombre' => $user->name,
                'link' => $link
            ];
            /*CRUDBooster::sendEmail([
                'to' => $user->email,
                'data' => $data,
                'template' => 'activacion_exitosa'
            ]);*/
        }
    }

    public function getAbuelo($idpadre)
    {
        $padre = DB::table('cms_users')->where('id', $idpadre)->first();
        if ($padre->cms_users_id) {
            $abuelo = DB::table('cms_users')->where('id', $padre->cms_users_id)->first();
            return $abuelo;
        } else {
            return null;
        }
    }
}
