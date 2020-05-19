@extends('crudbooster::admin_template')
@section('content')
    <div class="container-fluid">
        <div class="row buttons-carousel">
        @foreach($enterprises as $enterprise)
            {{--<img src="{{url($enterprise->logo)}}"/>--}}
        <a href="{{CRUDBooster::mainpath("?&enterpriseId=".$enterprise->id)}}" class="btn btn-primary {{Request::get('enterpriseId')==$enterprise->id ? "active" : "" }}">{{$enterprise->nombre}}</a>
        @endforeach
        </div> 
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    @if(!empty($current_empresa->nombre))
                        <h3 class="box-body text-center">Mostrando <strong>{{$current_empresa->nombre}}</strong></h3>
                    @else
                        <h3 class="box-body text-center">Mostrando Todos</h3>
                    @endif
                    {{--<div class="box-tools">
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
                    </div>--}}
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <ul class="products list-unstyled row">
                        @foreach($products as $product)
                            @if($product->product_type_id == 2)
                                <li class="col-lg-3 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> {{$product->title}}</div>
                                        <div class="panel-body">
                                            <div class="iframe-product-container">
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
                                <li class="col-lg-3 col-sm-12 col-xs-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> {{$product->title ? : substr($product->ogp['title'],0,strpos($product->ogp['title'],' ',strlen($product->ogp['title'])/2)) }}</div>
                                        <div class="panel-body">
                                                    <img class="attachment-img img-responsive" src="{{$product->image ? url($product->image) : $product->ogp['image']}}"  />
                                                    <!--<p class="text-primary">{{ strlen($product->ogp['title']) >= 120 ? substr($product->ogp['title'],0,120)." ..." : $product->ogp['title'] }}</p> -->
                                                    
                                        </div>
                                        <div class="panel-footer">
                                            @if(CRUDBooster::me()->estado || CRUDBooster::myPrivilegeid()!=3)
                                                <p><a href="{{$product->value}}" target="_blank" class="btn btn-primary text-center">Ver enlace</a></p>
                                            @else
                                                <p><a href="{{CRUDBooster::adminpath('resumen')}}" class="btn btn-success text-center">Activarme para ver el curso</a></p>
                                            @endif
                                            @if(CRUDBooster::myPrivilegeid()==2)
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
                                            @endif
                                        </div>
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