var validator = $("#EmpresaForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		nombre_empresa:{
			required: true
		}

	},
	messages: {
		nombre_empresa: {
			required: "Por favor, ingrese datos del nombre de la empresa"
		}
	}
}

$("#ButtonEmpresa").click(function(event) {
	if ($('#EmpresaForm').valid()) {
		$('.loader').addClass("is-active");
	} else {
		validator.focusInvalid();
	}
});