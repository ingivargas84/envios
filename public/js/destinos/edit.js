var validator = $("#DestinoEditForm").validate({
    ignore: [],
    onkeyup: false,
    rules: {
        destino: {
            required: true,
        }
    },
    messages: {
        destino: {
            required: 'Por favor, ingrese el destino',
        },
    }
});

$("#ButtonDestinoUpdate").click(function (event) {
    if ($('#DestinoEditForm').valid()) {
        $('.loader').addClass("is-active");
        var btnAceptar=document.getElementById("ButtonDestinoUpdate");
        var disableButton = function() { this.disabled = true; };
        btnAceptar.addEventListener('click', disableButton , false);
    } else {
        validator.focusInvalid();
    }
});
