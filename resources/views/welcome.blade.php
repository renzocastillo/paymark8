@extends('layout')
@section('navbar')
    <ul class="nav navbar-nav navbar-left">
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if(CRUDBooster::myName())
            <li>
                <a href="{{CRUDBooster::adminpath('')}}">Sesión Iniciada: {{CRUDBooster::myName()}}</a>
            </li>
            <li>
                <a href="{{CRUDBooster::adminpath('logout')}}">Cerrar Sesión</a>
            </li>
        @else
            <li>
                <a href="{{CRUDBooster::myName() ? CRUDBooster::adminpath('') : CRUDBooster::adminpath('login')}}">
                    Iniciar Sesión <i class="fas fa-sign-in-alt"></i></a>
            </li>
            <li>
                <a href="#modalRegistro" data-toggle="modal">Registrarse</a>
            </li>
        @endif
        {{-- <li>
                <a href="{{url('terminos-y-condiciones')}}">Términos y Condiciones</a>
            </li>  --}}
    </ul>
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <h2 class="fixed-header">Únete a {{ ucfirst(CRUDBooster::getSetting('appname')) }}</h2>
        </div>
        <div class="row carousel">
            @if(CRUDBooster::getSetting('slider_1'))
                <div class="picture" style=" background-image: url('{{CRUDBooster::getSetting('slider_1')}}'); ">
                    <div class="overlay"></div>
                </div>
            @endif
            @if(CRUDBooster::getSetting('slider_2'))
                <div class="picture" style=" background-image: url('{{CRUDBooster::getSetting('slider_2')}}'); ">
                    <div class="overlay"></div>
                </div>
            @endif
            @if(CRUDBooster::getSetting('slider_3'))
                <div class="picture" style=" background-image: url('{{CRUDBooster::getSetting('slider_3')}}'); ">
                    <div class="overlay"></div>
                </div>
            @endif
        </div>

    </div>
    <!--
    <div class="box">
        <div class="box-shadow">
                @if(CRUDBooster::getSetting('slider_1'))
        <img src="{{CRUDBooster::getSetting('slider_1') }}"/>
                @endif
            </div>
        </div>
-->
    <div class="container-fluid">
        <div class="row secvideo">
            <div class="col-sm-12 col-lg-5 col-lg-offset-2">
                <div align="center" class="embed-responsive embed-responsive-16by9  video">
                    <video id=video controls="true" preload="yes" poster="{{url('/uploads/poster.png')}}" playsinline
                           class="embed-responsive-item" data-id="{{$video->id}}">
                        <source src="{{$video->url}}" type="video/mp4">
                    </video>
                </div>
            </div>
            <div class="col-sm-12 col-lg-3 sectexto ">
                <button data-target="#modalRegistro" data-toggle="modal" type="button" class="button1">REGISTRARME
                    GRATIS
                </button>
                <div class="texto show-on-scroll">Comparte esta página y empieza a ganar
                    con {{ CRUDBooster::getSetting('appname') }}</div>
            </div>
        </div>
    </div>
    <!-- Sección logos empresas -->
    {{--<div class="container-fluid">
            <div class="row multiple-carousel">
            @foreach($empresas as $empresa)
                <img src="{{url($empresa->logo)}}"/>
            @endforeach
            </div>
    </div>--}}
    <div class="container-fluid anuncios">
        <h2 class="text-center">{{CRUDBooster::getSetting("cabecera_anuncios")}}</h2>
        <div class="row">
            @foreach($anuncios as $anuncio)
                <div class="col-sm-12 col-lg-3">
                    <a href="{{$anuncio->url}}" target="_blank">
                        <figure class="snip1529">
                            <img src="{{$anuncio->imagen}}" class="img-responsive"/>
                            <div class="hover"><i class="ion-android-open"></i></div>

                        </figure>
                    </a>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Sección Acerca de la empresa -->
    <section id="featured">
        <div class="container">
            @for ($i = 1; $i < 5; $i++)
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="titulo show-on-scroll text-center">
                            <span>{{CRUDBooster::getSetting("section_".$i."_header")}}</span></div>
                        {!!CRUDBooster::getSetting("section_".$i."_content")!!}
                    </div>
                    <div class="col-sm-6 col-lg-5 col-lg-offset-1">
                        <img src="{{CRUDBooster::getSetting("section_".$i."_image")}}" class="inline-photo">
                        <div class="overlay show-on-scroll"></div>
                    </div>
                </div>
            @endfor
            <div class="row">
                <div class="col-sm-12">
                    <div class="test show-on-scroll">
                        <p>Empieza a ganar con {{ ucfirst(CRUDBooster::getSetting('appname')) }}</p>
                        <button type="button" data-toggle="modal" data-target="#modalRegistro" class="button1">
                            REGISTRARME
                            GRATIS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade pg-show-modal" id="anuncio" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <img class="img-responsive" src="{{CRUDBooster::getSetting('imagen_popup') }}"/>
                </div>
                <!--<div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No,gracias</button>
                    <button type="button" class="btn btn-primary">Saber más</button>
                </div> -->
            </div>
        </div>
    </div>
    <!--/.Modal de Formulario de Registro -->
    <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="register_form" action="{{route('register')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header text-center pb-4">
                        <h3 class="modal-title w-100 black-text font-weight-bold" id="myModalLabel">
                            <strong>SIGN</strong>
                            <a class="blue-text font-weight-bold"><strong> UP</strong></a></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @if (isset($patrocinador->id))
                            <p class="text-center">Tu Linker patrocinador es: {{$patrocinador->name}}</p>
                        @else
                            <p class="text-center">Tu patrocinador
                                es: {{ strtoupper(CRUDBooster::getSetting('appname')) }} </p>
                        @endif
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user grey-text"></i> Nombre y Apellido:</label>
                            <input type="text" class="form-control" id="name" placeholder="Nombre y Apellido"
                                   name="name">
                        </div>
                        <div class="form-group">
                            <label for="country_id"><i class="fas fa-flag grey-text"></i> País:</label>
                            <select class="form-control" name="country_id" required>
                                <option selected hidden>Seleccione una opción</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="whatsapp"><i class="fas fa-phone grey-text"></i> Whatsapp:</label>
                            <input type="text" class="form-control" id="whatsapp"
                                   placeholder="Tu número sin tu código de país (Ej. 994735839)"
                                   name="whatsapp">
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope grey-text"></i> Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock prefix grey-text"></i> Contraseña:</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingresar Contraseña"
                                   name="password">
                        </div>
                        <div class="form-group">
                            <label for="pass2"><i class="fas fa-lock prefix grey-text"></i> Repetir contraseña:</label>
                            <input type="password" class="form-control" id="cfmPassword"
                                   placeholder="Repetir contraseña" name="cfmPassword">
                        </div>
                        <div class="form-group">
                            <p>
                                <input type="checkbox" name="terms" value="1" id="terms"> Acepto los <a
                                        href="{{url("terminos-y-condiciones")}}" target=_blank>términos y condiciones de
                                    uso de {{CRUDBooster::getSetting('appname')}}</a>
                            </p>
                        </div>
                        <input type="hidden" name="patrocinador" value="{{$patrocinador->id}}">
                    </div>
                    <div class="modal-footer">
                        <button id="registrarme" type="submit" class="btn-primary btn-lg btn-block">Registrarse</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection
