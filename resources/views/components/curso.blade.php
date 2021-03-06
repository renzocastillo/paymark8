<li class="col-lg-3 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <img class="attachment-img img-responsive" src="{{$course->featured_image? url($course->featured_image) : ''}}" />
            <div class="cardspace">
                <a href="{{ CRUDBooster::mainpath("detail/$course->id") }}">
                    <h4 class="text-primary titulo">
                        {{ $course->title ? substr($course->title,0,50): substr($course->ogp['title'],0,50) }}
                    </h4>
                </a>
                <p style="text-align: left">Un curso de {{$course->author}}</p>
                <div class="row price">
                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter">
                        <h4>$ {{$course->price}}</h4>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter">
                        @if(CRUDBooster::me()->estado || CRUDBooster::myPrivilegeid()!=3)
                            <a href="{{ CRUDBooster::mainpath("detail/$course->id") }}" class="btn btn-primary text-center">Ver
                                el curso</a>
                        @else
                            <a href="#" data-amount="{{$course->price}}" data-type="2" data-name="{{$course->title}}" data-id="{{$course->id}}"
                                class="btn btn-primary text-center pay">COMPRAR</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(CRUDBooster::myPrivilegeid()==2)
            <div class="panel-footer">
                <div class="row">
                    <a class="btn btn-success btn-edit" title="Editar"
                        href="{{ CRUDBooster::mainpath("edit/".$course->id."?return_url=".urlencode(Request::fullUrl())) }}"><i
                            class="fa fa-pencil"></i> Editar</a>
                    @php
                    
                    $params=
                    [
                        'return_url'=> CRUDBooster::mainpath(""),
                        'parent_table'=> 'courses',
                        'parent_columns'=>'title',
                        'parent_columns_alias'=>"Curso",
                        'parent_id'=>$course->id,
                        'foreign_key'=>'course_id',
                        'label'=>"Cursos"
                    ];
                    @endphp
                    <a class="btn btn-warning btn-edit" title="Modulos"
                    href="{{ CRUDBooster::adminpath('modules?'.http_build_query($params)) }}"><i
                        class="fa fa-pencil"></i> Módulos</a>
                    <a class="btn btn-danger btn-delete" title="Eliminar" href="javascript:;" onclick="swal({
                            title: 'Estás Seguro?',
                            text: 'No podrás recuperar estos datos!',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#ff0000',
                            confirmButtonText: '¡Sí!',
                            cancelButtonText: 'No',
                            closeOnConfirm: false
                            },
                            function(){
                            location.href= '{{ CRUDBooster::mainpath('delete/'.$course->id) }}';
                            });">
                        <i class="fa fa-times"></i> Eliminar
                    </a>
                </div>
            </div>
        @endif
    </div>
</li>