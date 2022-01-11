$.validator.addMethod("select", function (value, element, arg) {
    return arg !== value;
}, "Debe seleccionar una opción.");


var validator = $("#GuiaForm").validate({
	ignore: [],
	onkeyup:false,
	rules: {
		tipo_guia:{
			required: true
        },
        nombre_origen:{
			required: true
        },
        telefono_origen:{
			required: true
        },
        oficina_destino_id:{
            required: true,
            select: 'default'
        },
        nombre_destino:{
			required: true
        },
        telefono_destino:{
			required: true
        },
        
        total_flete:{
			required: true
        },
        oficina_origen_id:{
            required: true,
            select: 'default'
        },
        destino_id:{
            required: true,
            select: 'default'
        },
        tipo_cobro_id:{
            required: true,
            select: 'default'
        },
        descripcion_contenido:{
            required: true
		}
	},
	messages: {
		tipo_guia: {
			required: "Por favor, ingrese el tipo de guía"
        },
        nombre_origen: {
			required: "Por favor, ingrese el nombre origen"
        },
        telefono_origen: {
			required: "Por favor, ingrese el teléfono de origen"
        },
        descripcion_contenido: {
			required: "Por favor, ingrese la descripción del contenido"
        },
        oficina_origen_id: {
			required: "Por favor, selecciona la oficina de origen"
        },
        oficina_destino_id: {
			required: "Por favor, selecciona la oficina de destino"
        },
        nombre_destino: {
			required: "Por favor, ingrese el nombre del destino"
        },
        telefono_destino: {
			required: "Por favor, ingrese el teléfono de destino"
        },
        total_flete: {
			required: "Por favor, ingrese el total del flete"
        }
	}
});

