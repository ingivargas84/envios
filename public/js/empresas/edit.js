var validator = $("#EmpresaEditForm").validate({
    ignore: [],
    onkeyup: false,
    rules: {
        nombre_empresa: {
            required: true,
        }
    },
    messages: {
        nombre_empresa: {
            required: 'Por favor, ingrese el nombre de la empresa',
        },
    }
});

$("#ButtonEmpresaUpdate").click(function (event) {
    if ($('#EmpresaEditForm').valid()) {
        $('.loader').addClass("is-active");
        var btnAceptar=document.getElementById("ButtonEmpresaUpdate");
        var disableButton = function() { this.disabled = true; };
        btnAceptar.addEventListener('click', disableButton , false);
    } else {
        validator.focusInvalid();
    }
});
