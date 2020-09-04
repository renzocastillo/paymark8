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
                    <p>cursos / <b>{{$course->title}}</b></p>
                </div>       
                <div class="row equal ">
                    <div class="col-lg-8 col-sm-12 col-xs-12 pleft" >
                       <div>
                            <h2 style="margin-top:0px;">{{$course->title}}</h2>
                            <p style="text-align: left">Un curso de {{$course->author}}</p>
                       </div>                        
                       <div class="detail-carousel">
                            @foreach($galleryimages as $galleryimage)               
                                <img class="attachment-img img-responsive" src="{{url($galleryimage->url)}}"/>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-12 col-xs-12" >
                        <div class="panel panel-default total-height padding-panel">
                            <div class="panel-body ">
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
                                <ul class="features">
                                        <li class="list-item">
                                            <i class="fa fa-volume-up"></i> Audio en español                
                                        </li>
                                        <li class="list-item">
                                            <i class="fa fa-sign-in"></i> Acceso para siempre                                        
                                        </li>
                                        <li class="list-item">
                                            <i class="fa fa-clock-o"></i>A tu ritmo
                                        </li>
                                        <li class="list-item">
                                            <i class="fa fa-mobile"></i> Adaptado a móviles                                        
                                        </li>
                                </ul>
                            </div>
                            <div class="divpadding"><a href="{{CRUDBooster::adminpath('resumen')}}"
                                class="btn btn-primary text-center overflow">Se Linker y obtén acceso a todos los cursos a un solo precio</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row rowpadding content-style">
                    <h3>Acerca del curso</h3>
                    <p>{{ $course->description }}</p>
                </div>
                <div class="panel panel-default table-responsive">
                    <!-- Default panel contents -->
                    <div class="panel-heading">
                        <h4>Contenido del curso</h4>   
                    </div>
                  
                    <!-- Table -->
                    <table class="table table-hover">
                        <tbody>
                            @foreach($course->modules->sortBy('id') as $key=>$module)
                            <tr>
                              <td>{{++$key}}</td>
                              <td>{{$module->title}}</td>
                              <td class="buttonrigth"><a href="{{ CRUDBooster::mainpath('content/'.$course->id.'?module_id='.$module->id) }}" class="btn btn-primary text-center">Ver Contenido</a></td>
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
</div>             
@endsection