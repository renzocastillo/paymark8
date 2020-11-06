@extends('crudbooster::admin_template')
@section('content')

@component('components.checkout',
[
    'itemType'=>'1',
]) 
@endcomponent
<div class="container-fluid">
    <div class="row buttons-carousel">
        <a href="{{CRUDBooster::mainpath("")}}"
           class="btn btn-primary {{  Request::get('categoryId') ? "" : "active" }}">Todos</a>
           <a href="{{CRUDBooster::mainpath("?my_favourite=0")}}"
           class="btn btn-primary {{  Request::get('my_favourite')==0 ? "" : "active" }}">My Favorite Courses</a>
        @foreach($categories as $category)
            {{--<img src="{{url($category->logo)}}"/>--}}
            <a href="{{CRUDBooster::mainpath("?&categoryId=".$category->id)}}"
               class="btn btn-primary {{Request::get('categoryId')==$category->id ? "active" : "" }}">{{$category->nombre}}</a>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        <div class="box" style="overflow: hidden">
            <div class="box-body table-responsive padding" >
                <div class="addad-to-favorite" 
                style="
                display: none;
                position: absolute;
                background: #000032;
                color: #fff;
                font-weight: bold;
                z-index: 99;
                width: 100%;
                top: 0;
                left: 0;
                text-align: center;
                padding: 10px;
                font-size: 15px;">
                    fksdjkl
                </div>

                <div class="row padding-bottom">  
                    <p>cursos / <b>{{$course->title}}</b></p>
                </div>       
                <div class="row equal ">
                   
                    <div class="col-lg-8 col-sm-12 col-xs-12 pleft" >
                        
                       <div>
                           <div style="justify-content: space-between;flex-wrap:wrap">
                            <h2 style="margin-top:0px; display: inline-block">{{$course->title}}</h2>
                            @if(App\Models\FavoriteUserCourse::where([['cms_user_id',CRUDBooster :: myid ()],['course_id',$course->id]])->get()->count())
                                <i id="ajax-fevorite"  data-courseadd='true' data-courseid="{{$course->id}}" class="fa fa-star" style="margin-top:0px; display: inline-block; float: right; font-size: 30px;color: goldenrod;cursor: pointer;"></i>
                            @else
                                <i id="ajax-fevorite" data-courseadd='false' data-courseid="{{$course->id}}" class="fa fa-star" style="margin-top:0px; display: inline-block; float: right; font-size: 30px;cursor: pointer;"></i>
                            @endif

                           </div>
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
                                        <h3>${{$course->price}}</h3>
                                    </div>
                                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter" >
                                        @if(CRUDBooster::me()->estado || CRUDBooster::myPrivilegeid()!=3)
                                            <a href="{{$course->value}}" target="_blank"
                                                class="btn btn-primary text-center">Ver
                                                    el curso</a>
                                        @else
                                        <a title="Pay" class="btn btn-primary btn-md payment_btn pay"
                                        data-amount="{{$course->price}}" data-type="2" data-name="{{$course->title}}">COMPRAR</a>

                                            {{-- <a href="{{CRUDBooster::adminpath('resumen')}}"
                                                class="btn btn-primary text-center">COMPRAR</a> --}}
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
                            <div class="divpadding">
                                <a  itle="pagar" class="btn btn-primary text-center overflow" href="#pagar_modal"
                                data-toggle="modal">Se Linker y obtén acceso a todos los cursos a un solo precio</a>

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