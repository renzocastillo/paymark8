@extends('crudbooster::admin_template')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">

                    </h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    @if($tipo == 'video')
                        <ul class="iframes list-unstyled video-list-thumbs row">
                            @foreach($iframes as $iframe)
                                <li class="col-lg-4 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            {{$iframe->title}}
                                        </div>
                                        <div class="panel-body">
                                            <div class="iframe-container">
                                                {!! $iframe->html !!}
                                            </div>
                                        </div>
                                        @if(CRUDBooster::myPrivilegeid()==2)
                                            <div class="panel-footer">
                                                <a class="btn btn-success btn-edit" title="Editar"
                                                   href="{{CRUDBooster::mainpath("edit/".$iframe->id."?return_url=".urlencode(Request::fullUrl()))}}"><i
                                                            class="fa fa-pencil"></i> Editar</a>
                                                <a class="btn btn-danger btn-delete" title="Eliminar"
                                                   href="javascript:;"
                                                   onclick="swal({
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
                    {{-- @else
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
                                                 <a class="btn btn-success btn-edit" title="Editar"
                                                    href="{{CRUDBooster::mainpath("edit/".$iframe->id."?return_url=".urlencode(Request::fullUrl()))}}"><i
                                                             class="fa fa-pencil"></i> Editar</a>
                                                 <a class="btn btn-danger btn-delete" title="Eliminar"
                                                    href="javascript:;"
                                                    onclick="swal({
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
                         </ul>--}}
                @endif
                <!-- {{ $iframes->appends(['tipo' => $tipo])->links() }} -->
                </div>
            {{--<div class="box-footer">
                <ul class="pagination pagination-sm no-margin pull-right">
                    <li ><a href="{{$iframes->url(1)}}">«</a></li>
                    @for($i=1; $i<=$iframes->lastPage(); $i++)
                        <li class="{{ $iframes->currentPage()==$i?'active':''}}"><a href="{{$iframes->url($i)}}">{{$i}}</a></li>
                    @endfor
                    @if($iframes->lastPage()>1)
                        <li><a href="{{$iframes->url($iframes->lastPage())}}">»</a></li>
                    @endif
                </ul>
            </div>--}}
            <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>

    </div>

@endsection
