<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="_token" content="{{csrf_token()}}" />
        <title>{{CRUDBooster::getSetting('appname') }}</title>
        <link href="{{asset("css/app.css")}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset("css/slick.css")}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset("css/slick-theme.css")}}"/>
        <link rel="stylesheet" type="text/css" href="{{asset("css/style.css")}}"/>
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
                    <a class="navbar-brand" href="http://disputebills.com">
                        <img src="{{ CRUDBooster::getSetting('logo') }}">
                        {{CRUDBooster::getSetting('appname') }}
                    </a>
              </div>
              <div id="navbar7" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-left">
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{CRUDBooster::myName() ? CRUDBooster::adminpath('') : CRUDBooster::adminpath('login')}}">
                        <i class="fas fa-sign-in-alt"></i> 
                        @if(CRUDBooster::myName())
                            Sesión Iniciada: {{CRUDBooster::myName()}}
                        @else
                            Iniciar Sesión
                        @endif
                    </a>
                </li>
                </ul>
              </div>
              <!--/.nav-collapse -->
            </div>
            <!--/.container-fluid -->
        </nav>
        <div class="container-fluid">
            <div class="row carousel">
                @if(CRUDBooster::getSetting('slider_1'))
                    <img src="{{CRUDBooster::getSetting('slider_1') }}"/>
                @endif
                @if(CRUDBooster::getSetting('slider_2'))
                    <img src="{{CRUDBooster::getSetting('slider_2') }}"/>
                @endif
                @if(CRUDBooster::getSetting('slider_3'))
                    <img src="{{CRUDBooster::getSetting('slider_3') }}"/>
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

<!-- ---- html example --- -->
       
        <div class="row justify-content-center align-items-center topn100 bcolor">         
                <div class="col-sm-12">
                            <div align="center" class="embed-responsive embed-responsive-16by9 video" >                   
                                <video id=video controls class="embed-responsive-item" data-id="{{$video->id}}">
                                    <source src="{{$video->url}}" type="video/mp4" >
                                </video>
                            </div>
                            <div id="status" class="incomplete">
                                <span>Play status: </span>
                                <span class="status complete">COMPLETE</span>
                                <span class="status incomplete">INCOMPLETE</span>
                                <br />
                            </div>
                            <div>
                                <span id="played">0</span> seconds out of 
                                <span id="duration"></span> seconds. (only updates when the video pauses)
                            </div>
                </div>
        </div>
        
        <div class="row" style="margin-top: 100px;">
            <div class="col-sm-12">
                <div class="test show-on-scroll">
                    <p>¿Cómo ser parte de PayMark? Conoce más a cerca de nosotros y empieza a ganar compartiendo.</p>
                    <button type="button" class="btn btn-warning">Warning</button>
                </div>           
            </div>            
        </div>
        <div class="container-fluid">
        <div class="row" style="margin-top: 50px; margin-bottom: 50px">
        @foreach($anuncios as $anuncio)
        <div class="col-sm-12 col-lg-3">  
        <figure class="snip1529">
                <img src="{{$anuncio->imagen}}" alt="pr-sample13" style="width:350px;height:350px; object-fit:cover;" />
                <!-- <figcaption>
                    <h3>An Abstract Post Heading</h3>
                    <p>Which is worse, that everyone has his price, or that the price is always so low.</p>
                </figcaption>-->
                <div class="hover"><i class="ion-android-open"></i></div>
                <a href="{{$anuncio->url}}" target="_blank"></a>
        </figure>
        </div>   
        @endforeach
        </div>
        </div>       
  
        <div class="row multiple-carousel">
        @foreach($empresas as $empresa)
        <img src="{{$empresa->logo}}"/>
        @endforeach
        </div>       
        
<!-- Sección A cerca de la empresa -->
<section id="featured">
    <div class="container">
    	<div class="row">
            <div class="col-sm-12">
                <div class="titulo show-on-scroll"><span>A cerca de Nosotros</span></div>
            </div>
        </div>
        <div class="row" style="margin-top: 100px;">
            <div class="col-sm-6 contenedor">
                <img src="uploads/img1.jpg" class="inline-photo">
                <div class="overlay show-on-scroll"></div>
            </div>
            
            <div class="col-sm-6">
                <div class="content"><h2>Pixel Facial Cream</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
            </div>
            </div>
        </div>
        <div class="row" style="margin-top: 100px;">
            <div class="col-sm-6">
                <div class="content"> <h2>Pixel Facial Cream</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore.Lorem ipsum dolor sit amet, consectetur Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut.</p>
            </div>
            </div>   
            <div class="col-sm-6">
                <div class="image"><img src="uploads/imagen2.jpg" class="inline-photo show-on-scroll"></div>
                <div class="overlay show-on-scroll"></div>
            </div>  
        </div>
        

    </div>
 
</section>

<footer class="footer-distributed" style="margin-top: 100px;">

        <div class="footer-left">

            <h3>Company<span>logo</span></h3>

            <p class="footer-links">
                <a href="#" class="link-1">Home</a>
                
                <a href="#">Blog</a>
            
                <a href="#">Pricing</a>
            
                <a href="#">About</a>
                
                <a href="#">Faq</a>
                
                <a href="#">Contact</a>
            </p>

            <p class="footer-company-name">Company Name © 2015</p>
        </div>

        <div class="footer-center">

            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>444 S. Cedros Ave</span> Solana Beach, California</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+1.555.555.5555</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:support@company.com">support@company.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>About the company</span>
                Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
            </p>

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>

            </div>

        </div>

</footer>

<div class="modal fade pg-show-modal" id="anuncio" tabindex="-1" role="dialog" aria-hidden="true"> 
            <div class="modal-dialog"> 
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <h4 class="modal-title">Cuida el medio ambiente !</h4> 
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>                         
                    </div>                     
                    <div class="modal-body"> 
                        <p>En BCJ nos enfocamos en el cuidado del medio ambiente. Si quieres unirte a nosotros y nuestras campañas ecologistas escíbenos a unete@bcj.com</p> 
                    </div>                     
                    <div class="modal-footer"> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                         
                        <button type="button" class="btn btn-primary">Save changes</button>                         
                    </div>                     
                </div>                 
            </div>             
        </div>

        <script src="{{asset("js/app.js")}}"></script>
        <script type="text/javascript" src="{{asset("js/slick.min.js")}}"></script>
        <script type="text/javascript" src="{{asset("js/index.js")}}"></script>
    </body>
    

</html>
