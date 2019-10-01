<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{csrf_token()}}" />
        <meta name="theme-color" content="#000032">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
        <title>{{CRUDBooster::getSetting('appname') }}</title>
        <link rel="shortcut icon" href="{{ asset(CRUDBooster::getSetting('favicon')) }}">
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
                        <a href="{{CRUDBooster::myName() ? CRUDBooster::adminpath('') : CRUDBooster::adminpath('login')}}"> Iniciar Sesión <i class="fas fa-sign-in-alt"></i></a>
                    </li>
                    <li>
                        <a href="#modalRegistro"  data-toggle="modal">Registrarse</a> 
                    </li>
                @endif
                </ul>
              </div>
              <!--/.nav-collapse -->
            </div>
        <!--/.Modal de Formulario de Registro -->
        
        <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <form id="register_form" action="{{route('register')}}" method="POST">
                {{ csrf_field() }}
                <div class="modal-content">
                    <div class="modal-header text-center pb-4">
                        <h3 class="modal-title w-100 black-text font-weight-bold" id="myModalLabel"><strong>SIGN</strong>
                         <a class="blue-text font-weight-bold"><strong> UP</strong></a></h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name"><i class="fas fa-user grey-text"></i> Nombre y Apellido:</label>
                            <input type="text" class="form-control" id="name" placeholder="Nombre y Apellido" name="name">
                        </div>
                        <div class="form-group">
                            <label for="whatsapp"><i class="fas fa-phone grey-text"></i> Whatsapp:</label>
                            <input type="text" class="form-control" id="whatsapp" placeholder="Ej. 51969922331" name="whatsapp">
                        </div>
                        <div class="form-group">
                            <label for="email"><i class="fas fa-envelope grey-text"></i> Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">         
                            <label for="password"><i class="fas fa-lock prefix grey-text"></i> Contraseña:</label>
                            <input type="password" class="form-control" id="password" placeholder="Ingresar Contraseña" name="password">
                        </div>
                        <div class="form-group">         
                            <label for="pass2"><i class="fas fa-lock prefix grey-text"></i> Repetir contraseña:</label>
                            <input type="password" class="form-control" id="cfmPassword" placeholder="Repetir contraseña" name="cfmPassword">
                        </div>
                        <input type="hidden" name="patrocinador" value="{{$patrocinador->id}}">      
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn-primary btn-lg btn-block">Registrarse</button>
                    </div>
            
                </div>
            </form>
            </div>
        </div>
          

        <!--/.container-fluid -->
        </nav>
        <div class="container-fluid">
            <div class="row">
                <h2 class="fixed-header">Únete a Paymark</h2>
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
                                <div align="center" class="embed-responsive embed-responsive-16by9  video" >                   
                                    <video id=video controls="true" preload="yes" poster="{{url('/uploads/poster.png')}}" playsinline class="embed-responsive-item" data-id="{{$video->id}}">
                                        <source src="{{$video->url}}" type="video/mp4" >
                                    </video>
                                </div>
                    </div>
                    <div class="col-sm-12 col-lg-3 sectexto ">
                        <button data-target="#modalRegistro" data-toggle="modal" type="button" class="button1">REGISTRARME GRATIS</button>
                        <div class="texto show-on-scroll">Comparte esta página y empieza a ganar con PayMark</div>
                    </div>
            </div>
        </div>
        <!-- Sección logos empresas --> 
        <div class="container-fluid">
                <div class="row multiple-carousel">
                @foreach($empresas as $empresa)
                    <img src="{{url($empresa->logo)}}"/>
                @endforeach
                </div> 
        </div>     
        <div class="container-fluid anuncios">
            <h2 class="text-center">Asociados</h2>
            <div class="row" >
            @foreach($anuncios as $anuncio)
                <div class="col-sm-12 col-lg-3">
                    <a href="{{$anuncio->url}}" target="_blank">  
                        <figure class="snip1529">
                                <img src="{{$anuncio->imagen}}" class="img-responsive" />
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
    	<div class="row">
        <div class="col-sm-6 col-lg-6">
                <div class="titulo show-on-scroll text-center"><span>¿QUIÉNES SOMOS?</span></div>
                <p>Un gran equipo comprometido con brindar una nueva experiencia de compra para nuestros clientes y alcanzar la mayor audiencia referenciados por los mismos. </p>
            </div>  
            <div class="col-sm-6 col-lg-5 col-lg-offset-1">
                <img src="uploads/4.jpg" class="inline-photo">
                <div class="overlay show-on-scroll"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-lg-6">
                <div class="titulo show-on-scroll text-center"><span>¿QUÉ TE OFRECEMOS?</span></div>
                <p>Una nueva oportunidad de aprovechar tu activo social desde donde estés, a cualquier hora, por compartirnos con más personas, te ayudamos a conseguir ingresos extra.</p>
            </div>  
            <div class="col-sm-6 col-lg-5 col-lg-offset-1">
                <img src="uploads/1.jpg" class="inline-photo">
                <div class="overlay show-on-scroll"></div>
            </div>
        </div>
        <div class="row">        
            <div class="col-sm-6 col-lg-6">
                <div class="titulo show-on-scroll text-center"><span>¿POR QUÉ NOSOTROS?</span></div>
                <p>Porque no existe plataforma virtual similar, con un sistema de afiliaciones tan efectivo y comprobado, estamos preparados para recibir 50 millones de usuarios, somos una empresa seria y estructurada con un modelo de negocio que ha revolucionado el Marketing en todas sus formas.</p>
            </div> 
            <div class="col-sm-6 col-lg-5 col-lg-offset-1">
                <div class="image"><img src="uploads/2.jpg" class="inline-photo show-on-scroll"></div>
                <div class="overlay show-on-scroll"></div>
            </div>  
        </div>
        <div class="row">        
            <div class="col-sm-6 col-lg-6">
                <div class="titulo show-on-scroll text-center"><span>¿POR QUÉ TE QUEREMOS EN PAYMARK8?</span></div>
                <p>Junto a nuestro equipo sabemos que tienes la capacidad de hacer muchos amigos, tu activo social es muy valioso y como cliente satisfecho sabes compartir, unimos ambas habilidades y creamos justo el modelo de negocio que te conviene a ti.</p>
            </div> 
            <div class="col-sm-6 col-lg-5 col-lg-offset-1">

                <div class="image"><img src="uploads/3.jpg" class="inline-photo show-on-scroll"></div>
                <div class="overlay show-on-scroll"></div>
            </div>  
        </div>
        <div class="row">
            <div class="col-sm-12">                      
                <div class="test show-on-scroll">
                    <p>Empieza a ganar con PayMark8</p>
                    <button type="button" data-toggle="modal" data-target="#modalRegistro" class="button1">REGISTRARME GRATIS</button>
                </div>                        
            </div>
        </div>
    </div>
</section>

<footer class="footer-distributed">
        <div class="footer-left">
            <img class="footer-brand" src="{{ CRUDBooster::getSetting('logo') }}">
        </div>
        <div class="footer-center">
            <div>
                <i class="fa fa-phone"></i>
                <p>{{CRUDBooster::getSetting('whatsapp')}}</p>
            </div>
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
               Paymark - Todos los derechos Reservados.
               <br>
               Plataforma Digital Desarrollada por <a href="https://www.quaira.com" target="_blank">www.quaira.com</a>
            </p>
        </div>
</footer>

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

    </body>
    <script type="text/javascript" src="{{asset("js/index.js")}}"></script>
</html>
