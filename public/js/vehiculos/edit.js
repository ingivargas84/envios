var validator = $("#VehiculoEditForm").validate({
    ignore: [],
    onkeyup: false,
    rules: {
        no_placa: {
            required: true,
        },
        descripcion: {
            required: true,
        }
    },
    messages: {
        no_placa: {
            required: 'Por favor, ingrese el número de placa',
        },
        descripcion: {
            required: 'Por favor, ingrese la descripción del vehículo',
        }
    }
});

$("#ButtonVehiculoUpdate").click(function (event) {
    if ($('#VehiculoEditForm').valid()) {
        $('.loader').addClass("is-active");
        var btnAceptar=document.getElementById("ButtonVehiculoUpdate");
        var disableButton = function() { this.disabled = true; };
        btnAceptar.addEventListener('click', disableButton , false);
    } else {
        validator.focusInvalid();
    }
});
