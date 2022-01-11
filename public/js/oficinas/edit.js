var validator = $("#OficinaEditForm").validate({
    ignore: [],
    onkeyup: false,
    rules: {
        nombre: {
            required: true,
        }
    },
    messages: {
        nombre: {
            required: 'Por favor, ingrese el nombre de la oficina',
        },
    }
});

$("#ButtonOficinaUpdate").click(function (event) {
    if ($('#OficinaEditForm').valid()) {
        $('.loader').addClass("is-active");
        var btnAceptar=document.getElementById("ButtonOficinaUpdate");
        var disableButton = function() { this.disabled = true; };
        btnAceptar.addEventListener('click', disableButton , false);
    } else {
        validator.focusInvalid();
    }
});
