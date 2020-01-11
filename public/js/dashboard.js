$("#solicitar_pago").click(function () {
    sweetAlert({
        title: "Ingresa tu contraseña",
        text: 'Ingresa tu contraseña para poder continuar con la solicitud',
        type: 'input',
        inputType: 'password',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        animation: "slide-from-top"
    }, function (inputValue) {
        if (inputValue) {
            $.post("/api/validatePassword", {
                password: inputValue,
                id: window.myId
            }, function (data, status) {
                if (data) {
                    solicitar_popup();
                } else {
                    sweetAlert({
                        title: "¡Ups! Parece que te equivocaste",
                        text: 'La contraseña es incorrecta',
                        type: "warning",
                        showCancelButton: false,
                        confirmButtonText: 'Ok',
                        closeOnConfirm: true,
                    });
                }
            });
        }

    });
});

function solicitar_popup(e) {
    console.log('aqui pesh');
    var return_url = encodeURIComponent($(location).attr('href'));
    console.log(return_url);
    swal({
            title: '¿Estás seguro que quieres solicitar tu pago ?',
            text: 'Asegúrate que tú cuenta Paypal este correctamente digitada en PERFIL / CORREO PAYPAL. A través de este medio se abonarán tus comisiones',
            type: 'warning',
            showCancelButton: true,
            confirmButtonClass: 'danger',
            confirmButtonText: '¡Sí!',
            cancelButtonText: 'No',
            closeOnConfirm: false
        },
        function () {
            $('.sweet-alert button').prop('disabled', true);
            $('#solicitar_pago_form').submit();
        }
    )
};

function copy_to_clipboard() {
    console.log('copiando');
    var temp = $('<input>');
    $('#link_title').append(temp);
    temp.val($('#link').text()).select();
    document.execCommand('copy');
    temp.remove();
    $('.copied').text('link copiado!').show().fadeOut(1200);
};

$('.pay').click(function () {
    $('.loader-container').show();
    $('#pagar_modal').modal('hide');
    var amount = $(this).attr("data-amount");
    var userId = window.myId;
    $.post("/api/visanet/token", {
        amount: amount,
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
                })
            };
            script.src = response.data.script_url;
            script.setAttribute('data-sessiontoken', response.data.session);
            script.setAttribute('data-channel', response.data.channel);
            script.setAttribute('data-merchantid', response.data.merchant_id);
            script.setAttribute('data-amount', response.data.amount);
            script.setAttribute('data-expirationminutes', '5');
            script.setAttribute('data-purchasenumber', response.data.trx_id);
            script.setAttribute('data-timeouturl', response.data.url_timeout);
            script.setAttribute('data-merchantlogo', response.data.logo);
            script.setAttribute('data-usertoken', response.data.user);
            document.getElementById('form-to-pay').appendChild(script);
            $('#pay-startDate').html(response.data.start_date);
            $('#pay-endDate').html(response.data.end_date);
            $('#pay-amount').html(response.data.amount);
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
                title: "¡Ups! Parece que te equivocaste",
                text: 'La contraseña es incorrecta',
                type: "warning",
                showCancelButton: false,
                confirmButtonText: 'Ok',
                closeOnConfirm: true,
            });
        }
    });
});
if (window.myPurchase) {
    if (window.myPurchase.status == 'failed') {
        swal({
            title: "Ups! Hubo un error al completar el pago",
            text: '<div class="receipt">' +
                '<ul style="text-align: left"><li><b>Número de pedido:</b>  ' + window.myPurchase.transaction_invoice + '</li>' +
                '<li><b>Nombre y apellido del comprador:</b>  ' + window.myPurchase.name + '</li>' +
                '<li><b>Fecha y hora del pedido:</b>  ' + window.myPurchase.transaction_date + '</li>' +
                '<li><b>Descripcion:</b>  ' + window.myPurchase.eci_description + '</li>' +
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
        swal({
            title: "Pago completado exitosamente",
            text: '<div class="receipt">' +
                '<ul style="text-align: left"><li><b>Número de pedido:</b>  ' + window.myPurchase.transaction_invoice + '</li>' +
                '<li><b>Nombre y apellido del comprador:</b>  ' + window.myPurchase.name + '</li>' +
                '<li><b>Fecha y hora del pedido:</b>  ' + window.myPurchase.transaction_date + '</li>' +
                '<li><b>Importe de la transacción:</b>  ' + window.myPurchase.transaction_amount + '</li>' +
                '<li><b>Tipo de moneda:</b>  ' + window.myPurchase.transaction_currency + '</li>' +
                '<li><b>Producto:</b>  Ganancias ilimitadas, url un año, servidor de paymark un año</li>' +
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
/*
var boton = "button";
swal({
    title: "HTML <small>Title</small>!",
    text: '<ul><li>1</li><li>2</li><li>3</li></ul>',
    html: true,
    type: "success",
});*/
