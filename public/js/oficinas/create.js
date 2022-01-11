var validator = $("#OficinaForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		nombre:{
			required: true
		}

	},
	messages: {
		nombre: {
			required: "Por favor, ingrese datos del nombre de la oficina"
		}
	}
}

$("#ButtonOficina").click(function(event) {
	if ($('#OficinaForm').valid()) {
		$('.loader').addClass("is-active");
	} else {
		validator.focusInvalid();
	}
});