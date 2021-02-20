var itemtype ;
$('.pay').click(function (e) {
    e.preventDefault();
    $('.loader-container').show();
    $('#pagar_modal').modal('hide');
    itemtype =  $(this).attr("data-type");
    var item    = 
    {
        'type'  : $(this).attr("data-type"),
        'name'  : $(this).attr("data-name"),
        'amount': $(this).attr("data-amount"),
        'id'    : $(this).attr("data-id"),
    }
    var userId  = window.myId;
    $.post("/api/visanet/token", {
        item: item,
        userId: userId
    }, function (response, status) {
        if (response && response.success) {
            console.log(response);
            var script = document.createElement('script');
            script.type = 'text/javascript';
            script.async = true;
            script.onload = function () {
                $('.start-js-btn').attr('disabled', true);
                $('.start-js-btn').click(function () {
                    $('#myModal').modal('hide');
                    //$('.loader-container').show();
                    $(window).on('beforeunload', function () {
                        $('.loader-container').show();
                    });
                })


            };
            script.src = response.data.script_url;
            script.setAttribute('data-sessiontoken', response.data.session);
            script.setAttribute('data-channel', response.data.channel);
            script.setAttribute('data-merchantid', response.data.merchant_id);
            script.setAttribute('data-amount', response.data.item.amount);
            script.setAttribute('data-expirationminutes', '5');
            script.setAttribute('data-purchasenumber', response.data.trx_id);
            script.setAttribute('data-timeouturl', response.data.url_timeout);
            script.setAttribute('data-merchantlogo', response.data.logo);
            script.setAttribute('data-usertoken', response.data.user);
            document.getElementById('form-to-pay').appendChild(script);
            if(response.data.item.type == 1){
                console.log('es membresía');
                $('#pay-startDate').html(response.data.item.details.startDate);
                $('#pay-endDate').html(response.data.item.details.endDate);
            }
            $('#pay-id').val(response.data.item.id);
            $('#pay-name').html(response.data.item.name);
            $('#pay-amount').html(response.data.item.amount);
            $('.loader-container').hide();
            $('#myModal').modal('show');
            $('#terms').click(function () {
                var value = $('#terms').is(":checked");
                if (value) {
                    $('.start-js-btn').removeAttr('disabled');
                } else {
                    $('.start-js-btn').attr('disabled', true);
                }
            });
        } else {
            sweetAlert({
                title: "¡Ups! Por favor intenta nuevamente",
                text: 'Algo falló al conectarnos con Visanet',
                type: "warning",
                showCancelButton: false,
                confirmButtonText: 'Ok',
                closeOnConfirm: true,
            });
        }
    });
});
/*$(window).load(function() {
    $('.loader-container').show();
    $('.loader-container').fadeOut("slow");
});
$(window).on('load', function() {
    // do something 
	console.log("aqui");
	var iframe = document.getElementById("visaNetJS");
	console.log(iframe);
	var frm = iframe.contentWindow.document.getElementsByClassName("sky-form secure-form center");
	frm[0].id = "frmVisa";
});
$('.sky-form secure-form center show').on('submit', function(){
    alert('form submitted');
    // other code
});*/
if (window.myPurchase) {
    if (window.myPurchase.status == 'failed') {
        swal({
            title: "Ups! Hubo un error al completar el pago",
            text: '<div class="receipt">' +
                '<ul style="text-align: left"><li><b>Número de pedido:</b>  ' + window.myPurchase.transaction_invoice + '</li>' +
                '<li><b>Nombre y apellido del comprador:</b>  ' + window.myPurchase.name + '</li>' +
                '<li><b>Fecha y hora del pedido:</b>  ' + window.myPurchase.transaction_date + '</li>' +
                '<li><b>Descripcion:</b>  ' + window.myPurchase.action_description + '</li>' +
                '<li><b>Codigo de error:</b>  ' + window.myPurchase.eci_code + '</li>' +
                '</ul>' +
                '<a href="' + window.termsAndConditions + '" >Terminos y condiciones</a>' +
                '<a title="Imprimir" class="btn btn-primary " target="_blank" href="/visanet/transaction/' + window.myPurchase.id + '/print">Imprimir</a></div> ',
            html: true,
            type: "warning",
            confirmButtonText: 'Ok',
            closeOnConfirm: true,
        })
    } else if (window.myPurchase.status == 'insufficient_balance') {
        swal({
            title: "Saldo insuficiente",
            text: '<div class="receipt">' +
                '<ul style="text-align: left"><li><b>Número de pedido:</b>  ' + window.myPurchase.transaction_invoice + '</li>' +
                '<li><b>Nombre y apellido del comprador:</b>  ' + window.myPurchase.name + '</li>' +
                '<li><b>Fecha y hora del pedido:</b>  ' + window.myPurchase.transaction_date + '</li>' +
                '<li><b>Descripcion:</b>  Su cuenta no posee fondos</li>' +
                '<li><b>Codigo de error:</b>  ' + window.myPurchase.eci_code + '</li>' +
                '</ul>' +
                '<a href="' + window.termsAndConditions + '" >Terminos y condiciones</a>' +
                '<a title="Imprimir" class="btn btn-primary " target="_blank" href="/visanet/transaction/' + window.myPurchase.id + '/print" >Imprimir</a></div> ',
            html: true,
            type: "warning",
            confirmButtonText: 'Ok',
            closeOnConfirm: true,
        })

    } else if (window.myPurchase.status == 'accepted') {
        var type = ' ';
        if(itemtype==1)
        {
         type =  '<li><b>Producto: </b>  Afiliación a Plataforma Paymark8</li>' +
            '<li><b>Descripción: </b>  Ganancias ilimitadas, url un año, servidor de paymark un año</li>' ;
        }
        else
        {
            type =  '<li><b>Producto: </b>  course</li>';
        }
        swal({
            title: "Pago completado exitosamente",
            text: '<div class="receipt">' +
                '<ul style="text-align: left"><li><b>Número de pedido:</b>  ' + window.myPurchase.transaction_invoice + '</li>' +
                '<li><b>Nombre y apellido del comprador:</b>  ' + window.myPurchase.name + '</li>' +
                '<li><b>Fecha y hora del pedido:</b>  ' + window.myPurchase.transaction_date + '</li>' +
                '<li><b>Importe de la transacción:</b>  ' + window.myPurchase.transaction_amount + '</li>' +
                '<li><b>Tipo de moneda:</b>  ' + window.myPurchase.transaction_currency + '</li>' +
                '<li><b>Tarjeta:</b>  ' + window.myPurchase.card + '</li>' +
              type+
                '</ul>' +
                '<a href="' + window.termsAndConditions + '" >Terminos y condiciones</a>' +
                '<a title="Imprimir" class="btn btn-primary " target="_blank" href="/visanet/transaction/' + window.myPurchase.id + '/print">Imprimir</a></div> ',
            html: true,
            type: "success",
            confirmButtonText: 'Ok',
            closeOnConfirm: true,
        })
    }
}