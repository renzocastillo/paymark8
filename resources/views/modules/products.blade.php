@extends('crudbooster::admin_template')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">

                    </h3>
                    <div class="box-tools">
                        <form method="GET" action="" class="form-horizontal">
                            <div class="input-group input-group-sm" style="width: 200px;">
                                <select class="form-control pull-right" name="enterpriseId" required>
                                    <option selected value="0">
                                        Seleccione una empresa
                                    </option>
                                    @foreach($enterprises as $enterprise)
                                        <option value="{{$enterprise->id}}">{{$enterprise->nombre}}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <ul class="iframes list-unstyled row">
                        @foreach($products as $product)
                            @if($product->product_type_id == 2)
                                <li class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> {{$product->title}}</div>
                                        <div class="panel-body" style="height: 33vh;overflow-x: auto">
                                            <div class="iframe-container">
                                                {!! $product->value !!}
                                            </div>
                                        </div>
                                        @if(CRUDBooster::myPrivilegeid()==2)
                                            <div class="panel-footer">
                                                <a class="btn btn-success btn-edit" title="Editar"
                                                   href="{{CRUDBooster::mainpath("edit/".$product->id."?return_url=".urlencode(Request::fullUrl()))}}"><i
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
                                                           location.href= '{{CRUDBooster::mainpath('delete/'.$product->id)}}';
                                                           });">
                                                    <i class="fa fa-times"></i> Eliminar
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @else
                                <li class="col-lg-6 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> {{$product->title}}</div>
                                        <div class="panel-body" style="height: 33vh;overflow-x: auto">
                                            <div class="attachment-block clearfix">
                                                <img class="attachment-img" src="{{$product->ogp['image']}}"
                                                     alt="Attachment Image">

                                                <div class="attachment-pushed">
                                                    <h4 class="attachment-heading"><a
                                                                href="http://www.lipsum.com/">{{$product->title}}</a>
                                                    </h4>

                                                    <div class="attachment-text">
                                                        {{$product->ogp['title']}}
                                                        <a href="{{$product->ogp['url']}}" target="_blank">Más</a>
                                                    </div>
                                                    <!-- /.attachment-text -->
                                                </div>
                                                <!-- /.attachment-pushed -->
                                            </div>
                                        </div>
                                        @if(CRUDBooster::myPrivilegeid()==2)
                                            <div class="panel-footer">
                                                <a class="btn btn-success btn-edit" title="Editar"
                                                   href="{{CRUDBooster::mainpath("edit/".$product->id."?return_url=".urlencode(Request::fullUrl()))}}"><i
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
                                                           location.href= '{{CRUDBooster::mainpath('delete/'.$product->id)}}';
                                                           });">
                                                    <i class="fa fa-times"></i> Eliminar
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="box-footer">
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <li><a href="{{$products->url(1)}}">«</a></li>
                        @for($i=1; $i<=$products->lastPage(); $i++)
                            <li class="{{ $products->currentPage()==$i?'active':''}}"><a
                                        href="{{$products->url($i)}}">{{$i}}</a></li>
                        @endfor
                        @if($products->lastPage()>1)
                            <li><a href="{{$products->url($products->lastPage())}}">»</a></li>
                        @endif
                    </ul>
                </div>
                <!-- /.box-body -->
            </div>

        </div>
    </div>
@endsection