@extends('crudbooster::admin_template')
@section('content')
<div class="container-fluid">
    <div class="row buttons-carousel">
        <a href="{{CRUDBooster::mainpath("")}}"
           class="btn btn-primary {{  Request::get('categoryId') ? "" : "active" }}">Todos</a>
        @foreach($categories as $category)
            {{--<img src="{{url($category->logo)}}"/>--}}
            <a href="{{CRUDBooster::mainpath("?&categoryId=".$category->id)}}"
               class="btn btn-primary {{Request::get('categoryId')==$category->id ? "active" : "" }}">{{$category->nombre}}</a>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive padding">
                <div class="row padding-bottom">
                    <h2><i class="fa fa-arrow-left" aria-hidden="true" style="color:#3c6ef3;"></i> {{$course->title}}</h2>
                    <p style="text-align: left">Un curso de Ana Santos</p>
                </div>
                <div class="row equal ">
                    <div class="col-lg-8 col-sm-12 col-xs-12 pleft" >                        
                       <div class="detail-carousel">               
                                <img class="attachment-img img-responsive" src="{{url($course->featured_image)}}"/>
                                <img class="attachment-img img-responsive" src="{{url($course->featured_image)}}"/>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12" >
                        <div class="panel panel-default total-height">
                            <div class="panel-body padding-panel">
                                <div class="row price">
                                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter" >
                                        <h3>$20</h3>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter" >
                                        @if(CRUDBooster::me()->estado || CRUDBooster::myPrivilegeid()!=3)
                                            <a href="{{$course->value}}" target="_blank"
                                                class="btn btn-primary text-center">Ver
                                                    el curso</a>
                                        @else
                                            <a href="{{CRUDBooster::adminpath('resumen')}}"
                                                class="btn btn-primary text-center">COMPRAR</a>
                                        @endif
                                    </div>
                                </div>
                                <h4><i class="fa fa-volume-up" aria-hidden="true"></i> Audio en español</h4>
                                <h4><i class="fa fa-sign-in" aria-hidden="true"></i> Acceso para siempre</h4>
                                <h4><i class="fa fa-clock-o" aria-hidden="true"></i> A tu ritmo</h4>
                                <h4><i class="fa fa-mobile" aria-hidden="true"></i> Adaptado a móviles</h4>
                                <div class="divpadding"><a href="{{CRUDBooster::adminpath('resumen')}}"
                                                class="btn btn-primary text-center overflow">Se Linker y obtén acceso a todos los cursos a un solo precio</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row rowpadding content-style">
                    <h3>Acerca del Curso</h3>
                    <br>
                    <h4>Una vez que hayas realizado tus fotografías, pasarás a editarlas. Mina te hablará de las herramientas que ella suele utilizar para retocar sus imágenes con el móvil. Una vez estén listas, aprenderás a organizar tus redes sociales, planificando cuándo vas a publicar cada fotografía y programando los posts.Por último, Mina te explicará cómo sacar el máximo partido a Instagram Stories, la herramienta que permite compartir vídeos cortos y efímeros en Instagram.</h4>
                </div>
                <div class="panel panel-default table-responsive">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h4>Contenido del curso</h4>   
                    </div>
                  
                    <!-- Table -->
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                              <td>1</td>
                              <td>Presentación</td>
                              <td class="buttonrigth"><a href="/admin/module/1" class="btn btn-primary text-center">Ver Contenido</a></td>
                            </tr>
                            <tr>
                              <td>2</td>
                              <td>Creación de contenido</td>
                              <td class="buttonrigth"><a href="{{CRUDBooster::adminpath('resumen')}}" class="btn btn-primary text-center">Ver Contenido</a></td>
                            </tr>
                            <tr>
                              <td>3</td>
                              <td>Maquetación de Stories</td>
                              <td class="buttonrigth"><a href="{{CRUDBooster::adminpath('resumen')}}" class="btn btn-primary text-center">Ver Contenido</a></td>
                            </tr>
                            <tr>
                              <td>4</td>
                              <td>Edición del contenido</td>
                              <td class="buttonrigth"><a href="{{CRUDBooster::adminpath('resumen')}}" class="btn btn-primary text-center">Ver Contenido</a></td>
                            </tr>
                        </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>             
@endsection