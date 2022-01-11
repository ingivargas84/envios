var validator = $("#EmpleadoForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		nombre_empleado:{
			required: true
		}

	},
	messages: {
		nombre_empleado: {
			required: "Por favor, ingrese datos del nombre del empleado"
		}
	}
}

$("#ButtonEmpleado").click(function(event) {
	if ($('#EmpleadoForm').valid()) {
		$('.loader').addClass("is-active");
	} else {
		validator.focusInvalid();
	}
});