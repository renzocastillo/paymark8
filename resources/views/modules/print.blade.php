<html>
<head>
    <link href="{{asset("css/app.css")}}" rel="stylesheet">
    <script src="{{asset("js/app.js")}}"></script>
</head>
<body>
<img class="img-responsive" src="{{$logo}}" style="max-width:300px;">
@if($transaction->status == 'accepted')
    <ul style="text-align: left">
        <li><b>Número de pedido:</b> {{$transaction->transaction_invoice}} </li>
        <li><b>Nombre y apellido del comprador:</b> {{$transaction->name}} </li>
        <li><b>Fecha y hora del pedido:</b> {{$transaction->transaction_date}}</li>
        <li><b>Importe de la transacción:</b> {{$transaction->transaction_amount}}</li>
        <li><b>Tipo de moneda:</b> {{$transaction->transaction_currency}}</li>
        <li><b>Producto: </b>  Afiliación a Plataforma Paymark8</li>
        <li><b>Descripción: </b>  Ganancias ilimitadas, url un año, servidor de paymark un año</li>
        <li><b>Estado:</b> Aceptada</li>
    </ul>
@endif
@if($transaction->status == 'failed')
    <ul style="text-align: left">
        <li><b>Nombre y apellido del comprador:</b> {{$transaction->name}} </li>
        <li><b>Fecha y hora del pedido:</b> {{$transaction->transaction_date}}</li>
        <li><b>Descripcion:</b> {{$transaction->eci_description}} </li>
        <li><b>Codigo de error:</b> {{$transaction->eci_code}} </li>
        <li><b>Estado:</b> Rechazada</li>
    </ul>
@endif
</body>
<script type="application/javascript">
    window.print();
</script>
</html>