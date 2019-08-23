@extends('crudbooster::admin_template')
@section('content')
<div class="container">
    @if(CRUDBooster::me()->estado)
        <div class="row flyer success">
            <div class="col-lg-3 col-lg-push-1 col-sm-12">
                <h3> Tu link para compartir &nbsp;&nbsp;</h3>
            </div>
            <div class="col-lg-6 col-lg-push-2 col-sm-12">
                <h3><a title="Tu link de afiliacion" href="{{url('/'.CRUDBooster::me()->slug)}}" target="_blank" > <span class="label label-default">{{url('/'.CRUDBooster::me()->slug)}}</span></h3> </a>
            </div>
        </div>
        <br>
        <div class="row flyer warning">
          <div class="col-lg-5 col-lg-push-1 col-sm-12">
              <h3> Monto actual por cobrar:&nbsp;&nbsp;<h2>{{isset($monto_cobrar) ? 'S/'.$monto_cobrar : 'S/ 0'}}</h2> &nbsp;&nbsp;</h3>
          </div>
          <div class="col-lg-5 col-sm-12">
            <a title="Solicita tu pago por paypal" class="btn btn-default" data-toggle="modal" href="#solicitud_popup"  ><i class="fa fa-rocket"></i> Solicitar pago</a>
          </div>
      </div>
    @else
        <div class="row flyer info">
            <div class="col-lg-6 col-lg-push-1 col-sm-12">
                    <h3> Genera tu link y empieza a ganar con {{CRUDBooster::getsetting('appname')}}&nbsp;</h3>
            </div>
            <div class="col-lg-5 col-sm-12">
                    <a title="Paga y actívate" class="btn btn-default" data-toggle="modal" href="#pagar"  ><i class="fa fa-rocket"></i> Pagar Ahora</a>
            </div>
        </div>  
    @endif
</div>
<br>
<div class="container">
@include('crudbooster::statistic_builder.index',['id_cms_statistics'=>2])
</div>
<div id="pagar" class="modal fade" role="dialog">
        <div class="modal-dialog">
      
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Modal Header</h4>
            </div>
            <div class="modal-body">
              <p>Some text in the modal.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
      
        </div>
</div>
@endsection