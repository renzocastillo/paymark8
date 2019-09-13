@extends('crudbooster::admin_template')
@section('content')

  @if(app('request')->input('paypal_complete'))
    <div class="alert alert-warning">
        <strong>Pago concretado!</strong> Dentro de las próximas horas te llegará un correo confirmando tu activación.
    </div>
  @endif
  @if(CRUDBooster::getSetting('oficina_video_youtube'))
  <div class="row">
    <div class="col-sm-12 col-lg-4 col-lg-push-4">
        <div class="iframe-container">
            {!! CRUDBooster::getSetting('oficina_video_youtube') !!}
        </div>
    </div>
  </div>
  @endif
  <div class="row">
  @if(CRUDBooster::me()->estado)
    <div class="col-sm-3">
      <div class="small-box bg-blue">
          <div class="inner">
              <h3> Link</h3>
              <p><a title="Tu link de afiliacion" href="{{url('/'.CRUDBooster::me()->slug)}}" target="_blank" > <span class="badge badge-blue">{{url('/'.CRUDBooster::me()->slug)}}</span></a></p>
          </div>
          <div class="icon">
            <i class="fa fa-code"></i>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="small-box bg-yellow">
          <div class="inner">
              <h3> {{empty($capacidad_de_retiro) ? '$ 0' : '$ '.$capacidad_de_retiro }}</h3>
              <p>Capacidad de Retiro&nbsp;&nbsp;<a id="solicitar_pago"  title="Solicita tu pago por paypal" class="btn btn-default {{empty($capacidad_de_retiro) ? 'disabled' : ''}}" data-toggle="modal" onclick="solicitar_popup()" ><i class="fa fa-rocket"></i>Solicitar Pago</a></p>
          </div>
          <div class="icon">
            <i class="fa fa-trophy"></i>
          </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="small-box bg-green">
          <div class="inner">
              <h3>{{isset($monto_total) ? '$ '.$monto_total : '$ 0'}}</h3>
              <p> Ganancia Total</p>
          </div>
          <div class="icon">
            <i class="fa fa-usd"></i>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="small-box bg-blue">
          <div class="inner">
              <h3>{{isset($user->vistas_actuales) ? $user->vistas_actuales : 0}}</h3>
              <p> N° Vistas Actuales </p>
          </div>
          <div class="icon">
            <i class="fa fa-video-camera"></i>
        </div>
      </div>
    </div>
  @else
    <div class="col-sm-3">
      <div class="small-box bg-blue">
          <div class="inner">
            {!! CRUDBooster::getSetting('boton_paypal') !!}
              <p>Genera tu link y empieza a ganar con {{CRUDBooster::getsetting('appname')}}</p>
          </div>
          <div class="icon">
            <i class="fa fa-video-camera"></i>
        </div>
      </div>
    </div> 
  @endif
  </div>
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