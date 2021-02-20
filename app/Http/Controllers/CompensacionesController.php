<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ParametrosController;
use App\Models\CmsUserCourse;
use App\Models\Course;


class CompensacionesController extends Controller
{
    public $parametros;

    public function __construct()
    {
        $this->parametros = new ParametrosController();
    }
   
    public function getCapacidadDeRetiro($user){
        
        $pago_minimo = $this->parametros->getPagoMinimo();
        $course_commition = $this->getGinanciaporCourseswithdraw($user);
        $ganancia_x_vista = $this->parametros->getGananciaPorVista();
        $vistas_cobrables= $this->getVistasCobrables($user);
       
        $capacidad_de_retiro=
            $this->getGananciaPorAfiliadosActuales($user)+ $course_commition+
            $vistas_cobrables*$ganancia_x_vista;
        $capacidad_de_retiro= $capacidad_de_retiro > $pago_minimo ? $capacidad_de_retiro : 0;

        return $capacidad_de_retiro;

    }

    public function getCapacidadDeVistas($user){
        $hijos_actuales = $user->afiliaciones_actuales;
        $nietos_actuales = $user->nietos_actuales;
        $capacidad_de_vistas=$this->calCapacidadDeVistas($hijos_actuales,$nietos_actuales);
        $vistas_x_cobrar_last_solicitud=$this->getVistasporCobrarFromLastSolicitud($user);
        $capacidad_de_vistas=$capacidad_de_vistas+$vistas_x_cobrar_last_solicitud;
        return $capacidad_de_vistas;
    }

    public function getVistasporCobrarFromLastSolicitud($user){
        $solicitud=$this->getUltimaSolicitud($user);
        $capacidad_de_vistas=$this->calCapacidadDeVistas($solicitud->afiliados,$solicitud->nietos);
        $vistas_x_cobrar=$capacidad_de_vistas-$solicitud->vistas;
        return $vistas_x_cobrar;
    }

    public function calCapacidadDeVistas($hijos,$nietos){
        $vistas_x_nietos = $this->parametros->getCapacidadDeVistasPorNieto();
        $vistas_x_hijos = $this->parametros->getCapacidadDeVistasPorHijo();
        $capacidad_de_vistas=$hijos*$vistas_x_hijos + $nietos*$vistas_x_nietos;
        return $capacidad_de_vistas;
    }

    public function getVistasCobrables($user){
        $vistas_actuales = $user->vistas_actuales;
        $capacidad_de_vistas=$this->getCapacidadDeVistas($user);
        $vistas_cobrables= $vistas_actuales > $capacidad_de_vistas ? $capacidad_de_vistas : $vistas_actuales;
        return $vistas_cobrables;
    }

    public function getVistasAcumuladas($user){
        $vistas_actuales = $user->vistas_actuales;
        $capacidad_de_vistas=$this->getCapacidadDeVistas($user);
        $vistas_acumuladas=$vistas_actuales > $capacidad_de_vistas ? $vistas_actuales-$capacidad_de_vistas : 0; 
        return $vistas_acumuladas;
    }

    public function getVistasPorCobrar($user){
        $capacidad_de_vistas=$this->getCapacidadDeVistas($user);
        $vistas_cobrables=$this->getVistasCobrables($user);
        $vistas_x_cobrar=$capacidad_de_vistas- $vistas_cobrables;
        return $vistas_x_cobrar;
    }

    public function getMontoUltimaSolicitud($id)
    {
        $solicitud = DB::table('solicitudes_de_pago')
            ->where('cms_users_id', $id)
            ->latest()
            ->first();
        return $solicitud->monto;
    }

    public function getUltimaSolicitud($user){
        $solicitud = DB::table('solicitudes_de_pago')
            ->where('cms_users_id', $user->id)
            ->latest()
            ->first();
        return $solicitud;
    }

    public function getMontoSolicitudPremium($id)
    {
        //$ganancia_x_nietos=DB::table('parametros')->where('name','gnietos')->value('content');
        $vistas_x_nietos = $this->parametros->getCapacidadDeVistasPorNieto();
        $solicitud = DB::table('solicitudes_de_pago')
            ->where('cms_users_id', $id)
            ->latest()
            ->first();
        return $solicitud->nietos * $vistas_x_nietos;
    }

    public function getDolaresPorGanar($user){
        $capacidad_de_vistas=$this->getCapacidadDeVistas($user);
        $ganancia_x_vista=$this->parametros->getGananciaPorVista();
        $vistas_actuales=$user->vistas_actuales;
        $dolares_x_ganar = ($capacidad_de_vistas - $vistas_actuales) > 0 ? ($capacidad_de_vistas - $vistas_actuales) * $ganancia_x_vista : 0;
        return $dolares_x_ganar;
    }

    public function getTotalHistoricoDeGanancias($user){
        $total = DB::table('solicitudes_de_pago')->where('cms_users_id', $user->id)->sum('monto');
        return $total;
    }

    public function getGananciaPorVistasActuales($user){
        $ganancia_x_vista=$this->parametros->getGananciaPorVista();
        $ganancia_x_vistas_actuales = $user->vistas_actuales * $ganancia_x_vista;
        return $ganancia_x_vistas_actuales;
    }

    public function getGananciaPorAfiliadosActuales($user){
        $ganancia_x_afiliacion=$this->parametros->getGananciaporAfiliacion();
        $ganancia_x_afiliados_actuales=$user->afiliaciones_actuales * $ganancia_x_afiliacion;
        return $ganancia_x_afiliados_actuales;
    }
    public function getGananciaTotalActual($user){

        $ganancia_total_actual = $this->getGananciaPorVistasActuales($user) + $this->getGananciaPorAfiliadosActuales($user);
        return $ganancia_total_actual;
    }

    public function getPotencialDeGananciaporNietos($user){
        $vistas_x_nietos=$this->parametros->getCapacidadDeVistasPorNieto();
        $ganancia_x_vista=$this->parametros->getGananciaPorVista();
        $potencial_de_ganancia_x_nietos=$user->nietos_actuales*$vistas_x_nietos*$ganancia_x_vista;
        return $potencial_de_ganancia_x_nietos;
    }

    public function processPaymentRequest($id){
        //recuperamos la ultima solicitud de pago que fue agregada
        $row = DB::table('solicitudes_de_pago')->where('id', $id)->first();
        //recuperamos al usuario que solicitó el pago
        $user = DB::table('cms_users')->where('id', $row->cms_users_id)->first();
        $vistas_acumuladas=$this->getVistasAcumuladas($user);
        /*
        Reseteamos las vistas actuales del usuario a cero o lo dejamos con una
        cantidad residual si no pudo cobrar todas sus vistas.
        Reseteamos sus afiliados actuales a cero.
        Reseteamos la cantidad de nietos actuales a cero.
        */
        DB::table('cms_users')
            ->where('id', $user->id)
            ->update([
                'vistas_actuales' => $vistas_acumuladas,
                'afiliaciones_actuales' => 0,
                'nietos_actuales' => 0
            ]);
        
    }

    public function getGinanciaporCourseswithdraw($user){

        $percentage = $this->parametros->getPercentageCurso();
        
        $last_withdraw = DB::table('solicitudes_de_pago')
            ->where('cms_users_id',$user->id)
            ->orderBy('created_at','desc')->get();
        
        $cusers = DB::table('cms_users')
            ->where('cms_users_id',$user->id)
            ->get();
        $courses = 0;
        foreach($cusers as $cuser)
        {
            $cmscourses =  CmsUserCourse::where('cms_user_id',$cuser->id);
            if($last_withdraw->count()>0)
            {
                $cmscourses->where('created_at','>',$last_withdraw[0]->created_at);
            }
            $ccget = $cmscourses->get();
            foreach($ccget as $cmscourse)
            {

                $courses = $courses + Course::where('id',$cmscourse->course_id)->first()->price;
            }
        }
        $result  = $courses* $percentage / 100;

        return $result;
    }

    
    public function getGinanciaporCourses($user){

        $percentage = $this->parametros->getPercentageCurso();
        $cusers = DB::table('cms_users')
            ->where('cms_users_id',$user->id)
            ->get();
        $courses = 0;
        foreach($cusers as $cuser)
        {
            $cmscourses =  CmsUserCourse::where('cms_user_id',$cuser->id)->get();
            foreach($cmscourses as $cmscourse)
            {

                $courses = $courses + Course::where('id',$cmscourse->course_id)->first()->price;
            }
        }
        $result  = $courses* $percentage / 100;
        return $result;
    }

}
