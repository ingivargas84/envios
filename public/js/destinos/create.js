var validator = $("#DestinoForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		destino:{
			required: true
		}

	},
	messages: {
		destino: {
			required: "Por favor, ingrese datos del destino"
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