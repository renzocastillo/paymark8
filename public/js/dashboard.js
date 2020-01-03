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
    var amount = $(this).attr("data-amount");
    var userId = window.myId;
    $.post("/api/visanet/token", {
        amount: amount,
        userId: userId
    }, function (response, status) {
        if (response && response.success) {
            console.log(response);
           /* $('#form-to-pay').append('<script src="'+response.data.script_url+'" ' +
                'data-sessiontoken="'+response.data.session+'" '  +
                'data-channel="'+response.data.channel+'" ' +
                'data-merchantid="'+response.data.merchant_id+'" ' +
                'data-merchantlogo= \'img/comercio.png\' ' +
                'data-formbuttoncolor=\'#D80000\' ' +
                'data-purchasenumber="'+response.data.merchant_id+'" ' +
                'data-amount="'+response.data.amount+'" ' +
                'data-expirationminutes=\'5\' ' +
                'data-timeouturl = \'timeout.html\' ></script>');*/
            //$('#myModal').modal('show');
            sweetAlert({
                title: "¡Ups! Parece que te equivocaste",
                html: '<script src="'+response.data.script_url+'" ' +
                    'data-sessiontoken="'+response.data.session+'" '  +
                    'data-channel="'+response.data.channel+'" ' +
                    'data-merchantid="'+response.data.merchant_id+'" ' +
                    'data-merchantlogo= \'img/comercio.png\' ' +
                    'data-formbuttoncolor=\'#D80000\' ' +
                    'data-purchasenumber="'+response.data.merchant_id+'" ' +
                    'data-amount="'+response.data.amount+'" ' +
                    'data-expirationminutes=\'5\' ' +
                    'data-timeouturl = \'timeout.html\' ></script>',
                type: "warning",
                showCancelButton: false,
                confirmButtonText: 'Ok',
                closeOnConfirm: true,
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