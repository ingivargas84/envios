var validator = $("#EmpleadoEditForm").validate({
    ignore: [],
    onkeyup: false,
    rules: {
        nombre_empleado: {
            required: true,
        }
    },
    messages: {
        nombre_empleado: {
            required: 'Por favor, ingrese el nombre de la empresa',
        },
    }
});

$("#ButtonEmpleadoUpdate").click(function (event) {
    if ($('#EmpleadoEditForm').valid()) {
        $('.loader').addClass("is-active");
        var btnAceptar=document.getElementById("ButtonEmpleadoUpdate");
        var disableButton = function() { this.disabled = true; };
        btnAceptar.addEventListener('click', disableButton , false);
    } else {
        validator.focusInvalid();
    }
});
