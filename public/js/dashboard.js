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

$('.multiple-carousel').slick({
    dots: false,
    infinite: true,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 5,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [{
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        }
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
    ]
});