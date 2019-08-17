<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <div>
        <div class="row multiple-carousel">
        @foreach($empresas as $empresa)
            <img src="{{$empresa->logo}}"/>
        @endforeach
        </div>
        </div>
        <div class="container top3">
            <div class="row justify-content-center align-items-center">
                    <div class="col-sm-12">
                        <div align="center" class="embed-responsive embed-responsive-16by9">                   
                            <video controls class="embed-responsive-item">
                                <source src="{{$video->url}}" type="video/mp4">
                            </video>
                        </div>
                    </div>
            </div>
        </div>
        <div class="container-fluid top3">
            <div class="row">
            @foreach($anuncios as $anuncio)
            <a href="{{$anuncio->url}}" target="_blank">
                <img src="{{$anuncio->imagen}}" style="max-width:300px;">
            </a>
            @endforeach
        
            </div>
        </div>
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
