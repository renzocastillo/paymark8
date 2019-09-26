@extends('crudbooster::admin_template')
@section('content')
    @if($tipo == 'video')
        <ul class="iframes list-unstyled video-list-thumbs row">
            @foreach($iframes as $iframe)
                    <li class="col-lg-4 col-sm-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> {{$iframe->title}}</div>
                            <div class="panel-body">
                                <div class="iframe-container">
                                    {!! $iframe->html !!}
                                </div>
                            </div>
                            @if(CRUDBooster::myPrivilegeid()==2)
                                <div class="panel-footer">
                                    <a class="btn btn-success btn-edit" title="Editar" href="{{CRUDBooster::mainpath("edit/".$iframe->id."?return_url=".urlencode(Request::fullUrl()))}}"><i class="fa fa-pencil"></i> Editar</a>
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
                                            location.href= '{{CRUDBooster::mainpath('delete/'.$iframe->id)}}';
                                        });">
                                        <i class="fa fa-times"></i> Eliminar
                                    </a>
                                </div>
                            @endif
                        </div>    
                    </li>
            @endforeach
        </ul>
    @else
        <ul class="iframes list-unstyled row">
            @foreach($iframes as $iframe)
                    <li class="col-lg-2 col-sm-12 col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-heading"> {{$iframe->title}}</div>
                            <div class="panel-body">
                                {!! $iframe->html !!}
                            </div>
                            @if(CRUDBooster::myPrivilegeid()==2)
                            <div class="panel-footer">
                                <a class="btn btn-success btn-edit" title="Editar" href="{{CRUDBooster::mainpath("edit/".$iframe->id."?return_url=".urlencode(Request::fullUrl()))}}"><i class="fa fa-pencil"></i> Editar</a>
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
                                        location.href= '{{CRUDBooster::mainpath('delete/'.$iframe->id)}}';
                                    });">
                                    <i class="fa fa-times"></i> Eliminar
                                </a>
                            </div>
                            @endif
                        </div>
                    </li>    
            @endforeach
        </ul>
    @endif
@endsection