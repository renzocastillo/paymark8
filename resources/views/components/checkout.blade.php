
<div class="loader-container" style="display: none">
    <div class="loader"></div>
    <h3>Espera un momento por favor. No recargues la página</h3>
</div>
@if (Session::has('purchase'))
    <script>
        window.termsAndConditions = '{{url("terminos-y-condiciones")}}';
        window.myPurchase = @json(Session::pull('purchase'))
    </script>

@endif
@if(Session::has('timeout'))
    {{Session::pull('timeout')}}
    <div class="alert alert-danger">
        <strong>Se agoto el tiempo de espera para tu compra</strong> Intenta nuevamente
    </div>
@endif
@if(app('request')->input('paypal_complete'))
    <div class="alert alert-warning">
        <strong>Pago concretado!</strong> Dentro de las próximas horas te llegará un correo confirmando tu
        activación.
    </div>
@endif
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Confirma tu compra</h4>
            </div>
            <div class="modal-body">
                <ul>
                    @if($itemType == "1")
                            <li>Fecha de inicio membresia: <span id="pay-startDate"></span></li>
                            <li>Fecha de fin membresia: <span id="pay-endDate"></span></li>
                            <li>Producto: <span id="pay-name"></span></li>
                    @else
                            <li>Nombre del Curso: <span id="pay-name"></span></li>
                            
                    @endif
                            <li>Monto a pagar: <span id="pay-amount"></span></li>
                </ul>
            <form action="{{url('/visanet/checkout')}}" method='POST' id="form-to-pay">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <p>

                        <input type="checkbox" name="terms" value="1" id="terms" autocomplete="off">
                        <input type="hidden" name="item['type']" value="{{$itemType}}">
                        <input id="pay-id" type="hidden" name="item['id']" value="">
                            Acepto los <a href="{{url("terminos-y-condiciones")}}" target=_blank>términos y
                                condiciones de uso de {{CRUDBooster::getSetting('appname')}}</a>
                        </p>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>

    </div>
</div>