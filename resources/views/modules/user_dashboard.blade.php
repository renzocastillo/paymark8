@extends('crudbooster::admin_template')
@section('content')
    @component('components.checkout',
    [
        'itemType'=>'1'
    ]) 
    @endcomponent
    @if(CRUDBooster::me()->estado)
        <div class="row">
            <div class="col-sm-4 col-lg-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h4>Mi Link</h4>
                        <div class="copied"></div>
                        <h4 id="link_title">
                    <span id="link" class="badge badge-blue">
                        {{url('/'.CRUDBooster::me()->slug)}}
                    </span>
                        </h4>
                        <a id="copy_btn" class="btn btn-default" href="#" onclick="copy_to_clipboard()"><i
                                    class="fa fa-files-o" aria-hidden="true"></i></a>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user"></i>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-lg-5 col-lg-offset-1">
                <div class="small-box bg-green">
                    <div class="inner">
                        <div class="row">
                            <div class="col-sm-12 col-lg-5">
                                <h4> Suscripción Activa </h4>
                                <h5>Desde {{$fecha_de_activacion}}</h5>
                            </div>
                            <div class="col-sm-12 col-lg-5">
                                <h4>Tienes {{$dias_left}} días para usar {{CRUDBooster::getSetting('appname')}}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="icon">
                        <i class="fa fa-check"></i>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-4 col-lg-6">
                <div class="small-box bg-blue">
                    <div class="inner">
                        <h4>Genera tu link y empieza a ganar con {{CRUDBooster::getsetting('appname')}}</h4>
                        <a id="boton_paypal" title="pagar" class="btn btn-default" href="#pagar_modal"
                           data-toggle="modal">
                            <i class="fa fa-dollar"></i>
                            Pagar ahora
                        </a>
                    </div>
                    <div class="icon">
                        <i class="fa fa-video-camera"></i>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if(CRUDBooster::getSetting('oficina_video_youtube'))
        <div class="row">
            <div class="col-sm-12 col-lg-6">
                <div class="iframe-container">
                    {!! CRUDBooster::getSetting('oficina_video_youtube') !!}
                </div>
            </div>
            @endif
            <div class="col-sm-4 col-lg-5 col-lg-offset-1">
                <div class="container-fluid">
                    <div class="row">
                        <div id="cardborde" class="small-box bg-blue">
                            <div class="inner">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-6 ">
                                        <h3> {{empty($capacidad_de_retiro) ? '$ 0' : '$ '.$capacidad_de_retiro }}</h3>
                                        <h4>Capacidad de Retiro&nbsp;&nbsp;</h4>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 ">
                                        <a id="solicitar_pago" title="Solicita tu pago por paypal"
                                           class="btn btn-default {{empty($capacidad_de_retiro) ? 'disabled' : '' }}"
                                           data-toggle="modal" onclick="solicitar_popup()">
                                            <i class="fa fa-dollar"></i>
                                            Solicitar Pago
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="icon">
                                <i class="fa fa-usd"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{ $vistas_x_cobrar }}</h3>
                                <h4> Vistas por Cobrar</h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-trophy"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-box bg-blue">
                            <div class="inner">
                                <h3>{{$vistas_acumuladas}}</h3>
                                <h4> Vistas Acumuladas </h4>
                            </div>
                            <div class="icon">
                                <i class="fa fa-video-camera"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container-fluid">
            <div class="row multiple-carousel">
                @foreach($anuncios as $anuncio)
                    <img src="{{url($anuncio->imagen)}}"/>
                @endforeach
            </div>
        </div>
        <div class="container">
            <form id="solicitar_pago_form" method="post" enctype="multipart/form-data"
                  action={{CRUDBooster::adminpath('ganancias/add-save')}}>
                {{ csrf_field() }}
                <input type="hidden" name="return_url" value="{{Request::fullUrl()}}">
                <input type="hidden" name="cms_users_id" value="{{CRUDBooster::myid()}}">
                <input type="hidden" name="afiliados" value="{{$user->afiliaciones_actuales }}">
                <input type="hidden" name="nietos" value="{{$user->nietos_actuales }}">
                <input type="hidden" name="vistas" value="{{$vistas_cobrables }}">
                <input type="hidden" name="monto" value="{{$capacidad_de_retiro }}">
                <input type="hidden" name="estados_id" value="1">
            </form>
        </div>
        <div class="modal fade pg-show-modal" id="pagar_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-12 col-lg-4 text-center">
                                <div class="small-box bg-blue">
                                    <div class="inner">
                                        <h3>$10 /mes</h3>
                                        <h4> $120 / anual</h4>
                                        <p> Ganancias ilimitadas, url un año, servidor de paymark un año</p>
                                    </div>
                                    <a title="pagar" class="btn btn-default payment_btn disabled" data-toggle="modal">COMPRAR</a>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 text-center">
                                <div id="payment_card" class="small-box bg-blue">
                                    <div class="inner">
                                        <h3>$ {{$monthly_membership_amount_format}}/mes</h3>
                                        <h4>$ {{$annual_membership_amount_format}}/ anual (50% dcto)</h4>
                                        <p> Ganancias ilimitadas, url un año, servidor de paymark un año</p>
                                    </div>
                                    {{--
                                                                        {!! CRUDBooster::getSetting('boton_paypal') !!}
                                    --}}
                                    <a title="Pay" class="btn btn-warning btn-md payment_btn pay"
                                       data-amount="{{$annual_membership_amount}}" data-type="1" data-name="Membresía Paymark8 1 año">COMPRAR</a>
                                    <br><br>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-4 text-center">
                                <div class="small-box bg-blue">
                                    <div class="inner">
                                        <h3>$159 / 2 años</h3>
                                        <p> Ganancias ilimitadas, url dos años, servidor de paymark dos años</p>
                                    </div>
                                    <a title="pagar" class="btn btn-default payment_btn disabled" data-toggle="modal">COMPRAR</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
