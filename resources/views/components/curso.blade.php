<li class="col-lg-3 col-sm-12 col-xs-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <img class="attachment-img img-responsive"
                    src="{{$product->image ? url($product->image) : $product->ogp['image']}}"/>
            <div class="cardspace">
                <a href="{{CRUDBooster::mainpath("detail/$product->id")}}"><h4 class="text-primary titulo">{{$product->title ? substr($product->title,0,50): substr($product->ogp['title'],0,50) }}</h4></a>
                <p style="text-align: left">Un curso de Ana Santos</p>
                <div class="row price">
                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter" >
                        <h4>$20</h4>
                    </div>
                    <div class="col-lg-6 col-sm-6 col-xs-6 vcenter" >
                        @if(CRUDBooster::me()->estado || CRUDBooster::myPrivilegeid()!=3)
                            <a href="{{$product->value}}" target="_blank"
                                class="btn btn-primary text-center">Ver
                                    el curso</a>
                        @else
                            <a href="{{CRUDBooster::adminpath('resumen')}}"
                                class="btn btn-primary text-center">COMPRAR</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(CRUDBooster::myPrivilegeid()==2)
            <div class="panel-footer">
                <div class="row">
                    <a class="btn btn-success btn-edit" title="Editar"
                    href="{{CRUDBooster::mainpath("edit/".$product->id."?return_url=".urlencode(Request::fullUrl()))}}"><i
                                class="fa fa-pencil"></i> Editar</a>
                    <a class="btn btn-danger btn-delete" title="Eliminar"
                    href="javascript:;" onclick="swal({
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
            </div>
        @endif
    </div>
</li> 