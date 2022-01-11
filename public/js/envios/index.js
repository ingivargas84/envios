var envios_table = $('#envios-table').DataTable({
    "responsive": true,
    "processing": true,
    "info": true,
    "showNEntries": true,
    "dom": 'Bfrtip',

    lengthMenu: [
        [ 10, 25, 50, -1 ],
        [ '10 filas', '25 filas', '50 filas', 'Mostrar todo' ]
    ],

    "buttons": [
    'pageLength',
    'excelHtml5',
    'csvHtml5'
    ],

    "paging": true,
    "language": {
        "sdecimal":        ".",
        "sthousands":      ",",
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "No se encontraron resultados",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix":    "",
        "sSearch":         "Buscar:",
        "sUrl":            "",
        "sInfoThousands":  ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst":    "Primero",
            "sLast":     "Último",
            "sNext":     "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        },
    },
    "order": [0, 'desc'],

    "columns": [ {
        "title": "No",
        "data": "id",
        "width" : "5%",
        "responsivePriority": 1,
        "render": function( data, type, full, meta ) {
            return (data);},
    }, 

    {
        "title": "Oficina Envia",
        "data": "oficina_envia",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Oficina Recibe",
        "data": "oficina_recibe",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Vehículo",
        "data": "vehiculo",
        "width" : "15%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Piloto",
        "data": "piloto",
        "width" : "15%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Tot Cobrado",
        "data": "total_cobrado",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return  'Q. ' + Number.parseFloat((data)).toFixed(2);
        },
    },

    {
        "title": "Tot Por Cobrar",
        "data": "total_por_cobrar",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return  'Q. ' + Number.parseFloat((data)).toFixed(2);
        },
    },

    {
        "title": "Estado",
        "data": "estado_guia",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Acciones",
        "orderable": false,
        "width" : "15%",
        "render": function(data, type, full, meta) {
            var rol_user = $("input[name='rol_user']").val();
            var urlActual = $("input[name='urlActual']").val();

            if(full.estado_guia_id == 1){
                return "<div id='" + full.id + "' class='text-center'>" + 
                "<div class='float-left col-lg-4'>" + 
                "<a href='"+urlActual+"/show/"+full.id+"' class='show-envio' >" + 
                "<i class='fa fa-btn fa-eye' title='Ver Envio'></i>" + 
                "</a>" + "</div>" + 
                "<div class='float-center col-lg-4'>" + 
                "<a href='/envios/pdf/" + full.id + "' class='pdfEnvio'" + "' target='_blank'" + ">" +
                "<i class='fas fa-print' title='Imprimir Envío'></i>" +
                "</a>" + "</div>" +
                "<div class='float-center col-lg-4'>" + 
                "<a href='/envios/ruta/" + full.id + "' class='cambiar_estado' >" +
                "<i class='fas fa-bus' title='Poner Guías en Ruta'></i>" +
                "</a>" + "</div>";
            }
            else if(full.estado_guia_id == 2)
            {
                return "<div id='" + full.id + "' class='text-center'>" + 
                "<div class='float-left col-lg-4'>" + 
                "<a href='/envios/show/"+full.id+"' class='show-envio' >" + 
                "<i class='fa fa-btn fa-eye' title='Ver Envio'></i>" + 
                "</a>" + "</div>" + 
                "<div class='float-center col-lg-4'>" + 
                "<a href='/envios/pdf/" + full.id + "' class='pdfEnvio'" + "' target='_blank'" + ">" +
                "<i class='fas fa-print' title='Imprimir Envío'></i>" +
                "</a>" + "</div>" +
                "<div class='float-center col-lg-4'>" + 
                "<a href='/envios/oficina/" + full.id + "' class='cambiar_estado' >" +
                "<i class='fas fa-truck-loading' title='Recibir Guías en Oficina'></i>" +
                "</a>" + "</div>";
            }
            else if(full.estado_guia_id == 3)
            {
                return "<div id='" + full.id + "' class='text-center'>" + 
                "<div class='float-left col-lg-6'>" + 
                "<a href='/envios/show/"+full.id+"' class='show-envio' >" + 
                "<i class='fa fa-btn fa-eye' title='Ver Envio'></i>" + 
                "</a>" + "</div>" +
                "<div class='float-center col-lg-6'>" + 
                "<a href='/envios/pdf/" + full.id + "' class='pdfEnvio'" + "' target='_blank'" + ">" +
                "<i class='fas fa-print' title='Imprimir Envío'></i>" +
                "</a>" + "</div>";
            }
            else
            {
                return "<div id='" + full.id + "' class='text-center'>" + "</div>";
            }                 
            
        },
        "responsivePriority": 5
    }]

});
