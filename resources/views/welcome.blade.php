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
                <img src="https://quaira.com/wp-content/uploads/2019/02/pexels-photo-1181675.jpeg"/>
                <img src="https://quaira.com/wp-content/uploads/2019/07/Portada900-2-compressor-1.png"/>
                <img src="https://quaira.com/wp-content/uploads/2019/02/pexels-photo-247791-1.png"/>
            </div>
        </div>
        <div class="container top3">
            <div class="row justify-content-center align-items-center">
                    <div class="col-sm-12">
                        <div align="center" class="embed-responsive embed-responsive-16by9">
                            <video controls class="embed-responsive-item">
                                <source src="http://techslides.com/demos/sample-videos/small.mp4" type="video/mp4">
                            </video>
                        </div>
                    </div>
            </div>
        </div>
        <div class="container-fluid top3">
            <div class="row">
                <div class="col-sm-12 col-lg-3">
                    <div class="thumbnail">
                        <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
                        <div class="position-relative">
                            <img src="https://az818438.vo.msecnd.net/icons/slack.png" style="width:72px;height:72px;" />
                        </div>
                        <h4 id="thumbnail-label"><a href="https://flow.microsoft.com/en-us/connectors/shared_slack/slack/" target="_blank">Microsoft Slack</a></h4>
                        <p><i class="fas fa-sign-in-alt"></i> &nbsp;Auditor</p>
                        <div class="thumbnail-description smaller">Slack is a team communication tool, that brings together all of your team communications in one place, instantly searchable and available wherever you go.</div>
                        </div>
                        <div class="caption card-footer text-center">
                        <ul class="list-inline">
                            <li><i class="people lighter"></i>&nbsp;7 Active Users</li>
                            <li></li>
                            <li><i class="fas fa-sign-in-alt"></i> </li>
                        </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                        <div class="thumbnail">
                            <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
                            <div class="position-relative">
                                <img src="https://az818438.vo.msecnd.net/icons/slack.png" style="width:72px;height:72px;" />
                            </div>
                            <h4 id="thumbnail-label"><a href="https://flow.microsoft.com/en-us/connectors/shared_slack/slack/" target="_blank">Microsoft Slack</a></h4>
                            <p><i class="fas fa-sign-in-alt"></i> &nbsp;Auditor</p>
                            <div class="thumbnail-description smaller">Slack is a team communication tool, that brings together all of your team communications in one place, instantly searchable and available wherever you go.</div>
                            </div>
                            <div class="caption card-footer text-center">
                            <ul class="list-inline">
                                <li><i class="people lighter"></i>&nbsp;7 Active Users</li>
                                <li></li>
                                <li><i class="fas fa-sign-in-alt"></i> </li>
                            </ul>
                            </div>
                        </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                        <div class="thumbnail">
                            <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
                            <div class="position-relative">
                                <img src="https://az818438.vo.msecnd.net/icons/slack.png" style="width:72px;height:72px;" />
                            </div>
                            <h4 id="thumbnail-label"><a href="https://flow.microsoft.com/en-us/connectors/shared_slack/slack/" target="_blank">Microsoft Slack</a></h4>
                            <p><i class="fas fa-sign-in-alt"></i> &nbsp;Auditor</p>
                            <div class="thumbnail-description smaller">Slack is a team communication tool, that brings together all of your team communications in one place, instantly searchable and available wherever you go.</div>
                            </div>
                            <div class="caption card-footer text-center">
                            <ul class="list-inline">
                                <li><i class="people lighter"></i>&nbsp;7 Active Users</li>
                                <li></li>
                                <li><i class="fas fa-sign-in-alt"></i> </li>
                            </ul>
                            </div>
                        </div>
                </div>
                <div class="col-sm-12 col-lg-3">
                        <div class="thumbnail">
                            <div class="caption text-center" onclick="location.href='https://flow.microsoft.com/en-us/connectors/shared_slack/slack/'">
                            <div class="position-relative">
                                <img src="https://az818438.vo.msecnd.net/icons/slack.png" style="width:72px;height:72px;" />
                            </div>
                            <h4 id="thumbnail-label"><a href="https://flow.microsoft.com/en-us/connectors/shared_slack/slack/" target="_blank">Microsoft Slack</a></h4>
                            <p><i class="fas fa-sign-in-alt"></i> &nbsp;Auditor</p>
                            <div class="thumbnail-description smaller">Slack is a team communication tool, that brings together all of your team communications in one place, instantly searchable and available wherever you go.</div>
                            </div>
                            <div class="caption card-footer text-center">
                            <ul class="list-inline">
                                <li><i class="people lighter"></i>&nbsp;7 Active Users</li>
                                <li></li>
                                <li><i class="fas fa-sign-in-alt"></i> </li>
                            </ul>
                            </div>
                        </div>
                </div>

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
