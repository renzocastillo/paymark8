$("#solicitar_pago").click(function () {
    sweetAlert({
        title: "¡Ingresa tu contraseña!",
        text: 'Ingrese la contraseña del usuario autenticado',
        type: 'input',
        inputType: 'password',
        showCancelButton: true,
        closeOnConfirm: false,
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar',
        animation: "slide-from-top"
    }, function (inputValue) {
        if(inputValue){
            $.post("/api/validatePassword", {
                password: inputValue,
                id: window.myId
            }, function (data, status) {
                if (data) {
                    solicitar_popup();
                } else {
                    sweetAlert({
                        title: "¡Error!",
                        text: 'La contraseña es incorrecta',
                        type: "error",
                        showCancelButton: false,
                        confirmButtonText: 'Aceptar',
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