var validator = $("#GuiaForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		nombre_recibe:{
			required: true
		}

	},
	messages: {
		nombre_recibe: {
			required: "Por favor, ingrese datos del nombre de quien recibe"
		}
	}
}

$("#ButtonGuia").click(function(event) {
	if ($('#GuiaForm').valid()) {
		$('.loader').addClass("is-active");
	} else {
		validator.focusInvalid();
	}
});