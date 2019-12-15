<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{csrf_token()}}" />
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="theme-color" content="#000032">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <title>{{CRUDBooster::getSetting('appname') }}</title>
        <link rel="apple-touch-icon" sizes="32x32" href="{{ asset(CRUDBooster::getSetting('favicon')) }}">
        <link rel="icon" sizes="32x32" href="{{ asset(CRUDBooster::getSetting('favicon')) }}">
        <link href="{{asset("css/app.css")}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset("css/slick.css")}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset("css/slick-theme.css")}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}"/>
        <script src="{{asset("js/app.js")}}"></script>
        <script type="text/javascript" src="{{asset("js/jquery.validate.min.js")}}"></script>
        <script type="text/javascript" src="{{asset("js/localization/messages_es_PE.js")}}"></script>
        <script type="text/javascript" src="{{asset("js/slick.min.js")}}"></script>
    </head>
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar7">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{ CRUDBooster::getSetting('logo') }}">
                        </a>
                </div>
                <div id="navbar7" class="navbar-collapse collapse">
                    @yield('navbar')
                </div>
                <!--/.nav-collapse -->
            </div>
        <!--/.container-fluid -->
        </nav>
    @yield('content')
    @section('footer')
        <footer class="footer-distributed">
                <div class="footer-left">
                    <a href="{{url('/')}}">
                        <img class="footer-brand" src="{{ CRUDBooster::getSetting('logo') }}">
                    </a>
                    <br><br>
                    <a href="{{url('terminos-y-condiciones')}}"><i class="fas fa-book"></i> Términos y Condiciones</a>
                </div>
                <div class="footer-center">
                    @if(!empty(CRUDBooster::getSetting('whatsapp')))
                    <div>
                        <i class="fa fa-phone"></i>
                        <p>{{CRUDBooster::getSetting('whatsapp')}}</p>
                    </div>
                    @endif
                    <div>
                        <i class="fa fa-envelope"></i>
                        <p><a href="mailto:{{CRUDBooster::getSetting('correo')}}">{{CRUDBooster::getSetting('correo')}}</a></p>
                    </div>
                </div>
                <div class="footer-right">
                    <div class="footer-icons">
                        @if(!empty(CRUDBooster::getSetting('facebook')))
                            <a href="{{CRUDBooster::getSetting('facebook') }}" target="_blank" ><i class="fab fa-facebook"></i></a>
                        @endif
                        @if(!empty(CRUDBooster::getSetting('instagram')))
                            <a href="{{CRUDBooster::getSetting('instagram') }}"target="_blank" ><i class="fab fa-instagram"></i></a>
                        @endif
                    </div>
                    <p class="footer-company-about">
                        <span>{{CRUDBooster::getSetting('appname') }}</span>
                    <br>
                    <h5 class="text-justify">Cada compra realizada a través de esta plataforma digital, a cualquiera de nuestros proveedores, será en beneficio de PayMark8.com que recibirá una comisión a través del programa de afiliados y los enlaces con los que contamos, esta plataforma tiene como finalidad aportar valor a la comunidad y sobre todo ayudarte en el proceso de creación del proyecto de mayor alcance de tu audiencia en Línea.</h5>
                    <br>
                    <br>
                    {{ CRUDBooster::getSetting('appname') }} - Todos los derechos Reservados.
                    <!--Plataforma Digital Desarrollada por <a href="https://www.quaira.com" target="_blank">www.quaira.com</a>--> 
                    </p>
                </div>
        </footer>
    @show      
    </body>
    <script type="text/javascript" src="{{asset("js/index.js")}}"></script>
</html>
