var validator = $("#DestinoForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		no_placa:{
			required: true
        },
        descripcion:{
			required: true
		}

	},
	messages: {
		no_placa: {
			required: "Por favor, ingrese el número de placa"
        },
        descripcion: {
			required: "Por favor, ingrese la descripción del vehículo"
		}
	}
});

$("#ButtonDestino").click(function(event) {
	if ($('#DestinoForm').valid()) {
		$('.loader').addClass("is-active");
	} else {
		validator.focusInvalid();
	}
});