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
            script.onload = function(){
                $('.start-js-btn').attr('disabled', true);
            };
            script.src = response.data.script_url;
            script.setAttribute('data-sessiontoken',response.data.session);
            script.setAttribute('data-channel',response.data.channel);
            script.setAttribute('data-merchantid',response.data.merchant_id);
            script.setAttribute('data-amount',response.data.amount);
            script.setAttribute('data-purchasenumber',12);
            script.setAttribute('data-expirationminutes','5');
            script.setAttribute('data-purchasenumber',response.data.trx_id);
            script.setAttribute('data-timeouturl','/timeout');
            script.setAttribute('data-merchantlogo',response.data.logo);
            script.setAttribute('data-usertoken',response.data.user);
            document.getElementById('form-to-pay').appendChild(script);
            $('.loader-container').hide();
            $('#myModal').modal('show');
            $('#terms').click(function () {
                $('.start-js-btn').removeAttr('disabled');
            })


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
if(window.myPurchase){
    if(window.myPurchase.status == 'failed'){
        sweetAlert({
            title: "Ups! Hubo un error al completar el pago",
            text: 'por favor dirígete al menú Atención al Cliente e indica el problema con este código de referencia ' +window.myPurchase.eci_code,
            type: "warning",
            showCancelButton: false,
            confirmButtonText: 'Ok',
            closeOnConfirm: true,
        });
    }else  if(window.myPurchase.status == 'insufficient_balance'){
        sweetAlert({
            title: "Saldo insuficiente",
            text: 'Su cuenta no posee fondos',
            type: "warning",
            showCancelButton: false,
            confirmButtonText: 'Ok',
            closeOnConfirm: true,
        });
    }else  if(window.myPurchase.status == 'accepted'){
        sweetAlert({
            title: "Pago completado exitosamente",
            type: "success",
            showCancelButton: false,
            confirmButtonText: 'Ok',
            closeOnConfirm: true,
        });
    }
}

