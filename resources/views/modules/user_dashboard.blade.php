@extends('crudbooster::admin_template')
@section('content')
<div class="container">
  @if(app('request')->input('paypal_complete'))
  <div class="alert alert-warning">
      <strong>Pago concretado!</strong> Dentro de las próximas horas te llegará un correo confirmando tu activación.
  </div>
  @endif
    <div class="row">
      <div class="col-sm-12 col-lg-4 col-lg-push-4">
          <div class="iframe-container">
              {!! CRUDBooster::getSetting('oficina_video_youtube') !!}
          </div>
      </div>
    </div>
    @if(CRUDBooster::me()->estado)
        <div class="row flyer success">
            <div class="col-lg-3 col-lg-push-1 col-sm-12">
                <h3> Tu link para compartir &nbsp;&nbsp;</h3>
            </div>
            <div class="col-lg-6 col-lg-push-2 col-sm-12">
                <h3><a title="Tu link de afiliacion" href="{{url('/'.CRUDBooster::me()->slug)}}" target="_blank" > <span class="label label-default">{{url('/'.CRUDBooster::me()->slug)}}</span></h3> </a>
            </div>
        </div>
        <br>
        <div class="row flyer success">
          <div class="col-lg-5 col-lg-push-1 col-sm-12">
              <h3> Capacidad de Retiro:&nbsp;&nbsp;<h2>{{empty($capacidad_de_retiro) ? '$ 0' : '$ '.$capacidad_de_retiro }}</h2> &nbsp;&nbsp;</h3>
          </div>
          <div class="col-lg-5 col-sm-12">
          <a title="Solicita tu pago por paypal" class="btn btn-default {{empty($capacidad_de_retiro) ? 'disabled' : ''}}" data-toggle="modal" onclick="solicitar_popup()" ><i class="fa fa-rocket"></i> Solicitar pago</a>
          </div>
        </div>
        <br>
        <div class="row flyer warning">
          <div class="col-lg-5 col-lg-push-1 col-sm-12">
              <h3> Ganancia Total:&nbsp;&nbsp;<h2>{{isset($monto_total) ? '$ '.$monto_total : '$ 0'}}</h2> &nbsp;&nbsp;</h3>
          </div>
        </div>
        <br>
        <div class="row flyer warning">
          <div class="col-lg-5 col-lg-push-1 col-sm-12">
              <h3> N° Vistas Actuales :&nbsp;&nbsp;<h2>{{isset($user->vistas_actuales) ? $user->vistas_actuales : 0}}</h2> &nbsp;&nbsp;</h3>
          </div>
          <div class="col-lg-5 col-sm-12">
            
          </div>
        </div>
    @else
        <div class="row flyer info">
            <div class="col-lg-6 col-lg-push-1 col-sm-12">
              <h3> Genera tu link y empieza a ganar con {{CRUDBooster::getsetting('appname')}}&nbsp;</h3>      
            </div>
            <div class="col-lg-5 col-sm-12">
                {!! CRUDBooster::getSetting('boton_paypal') !!}
            </div>
        </div>  
    @endif
</div>
<br>
<div class="container">
  <form id="solicitar_pago" method="post" enctype="multipart/form-data" action={{CRUDBooster::adminpath('ganancias/add-save')}}>
    {{ csrf_field() }}
    <input type="hidden" name="return_url" value="{{Request::fullUrl()}}">
    <input type="hidden" name="cms_users_id" value="{{CRUDBooster::myid()}}">
    <input type="hidden" name="afiliados" value="{{$user->afiliaciones_actuales }}">
    <input type="hidden" name="vistas" value="{{$vistas_x_cobrar }}">
    <input type="hidden" name="monto" value="{{$capacidad_de_retiro }}">
    <input type="hidden" name="estados_id" value="1">
  </form> 
</div>
@endsection