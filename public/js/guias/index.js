var guias_table = $('#guias-table').DataTable({
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
        "title": "No Guía",
        "data": "no_guia",
        "width" : "10%",
        "responsivePriority": 1,
        "render": function( data, type, full, meta ) {
            return (data);},
    }, 

    {
        "title": "Envia",
        "data": "nombre_origen",
        "width" : "15%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Recibe",
        "data": "nombre_destino",
        "width" : "15%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },
        
    {
        "title": "Tot Flete",
        "data": "total_flete",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Tipo Cobro",
        "data": "tipo_cobro",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Fecha Creación",
        "data": "created_at",
        "width" : "10%",
        "responsivePriority": 4,
        "render": function( data, type, full, meta ) {
            return (data);},
    },

    {
        "title": "Estado",
        "data": "estado_guia",
        "width" : "5%",
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
            
            if(full.estado_guia_id == 5){
                return "<div id='" + full.id + "' class='text-center'>" + 
                "<div class='float-center col-lg-12'>" + 
                "<a href='/guias/show/"+full.id+"' class='ver-guia' >" + 
                "<i class='fas fa-eye' title='Ver Guía'></i>" + 
                "</a>" + "</div>";
            }
            else if(full.estado_guia_id == 1)
            {
                return "<div id='" + full.id + "' class='text-center'>" + 
                "<div class='float-center col-lg-3'>" + 
                "<a href='/reportes/guias/"+ full.id +"' class='imprime-guia' target='_blank' >" + 
                "<i class='fas fa-print' title='Imprimir Guía'></i>" + 
                "</a>" + "</div>" +
                "<div class='float-center col-lg-3'>" + 
                "<a href='/guias/show/"+full.id+"' class='ver-guia' >" + 
                "<i class='fas fa-eye' title='Ver Guía'></i>" + 
                "</a>" + "</div>" +
                "<div class='float-center col-lg-3'>" + 
                "<a href='/guias/edit/"+full.id+"' class='edit-guia' >" + 
                "<i class='fa fa-btn fa-edit' title='Editar Guía'></i>" + 
                "</a>" + "</div>" +
                "<div class='float-center col-lg-3'>" + 
                "<a href='/guias/entrega/"+full.id+"' class='entrega-guia' >" + 
                "<i class='fas fa-hands-helping' title='Entregar Guía'></i>" + 
                "</a>" + "</div>";
            }
            else
            {
                return "<div id='" + full.id + "' class='text-center'>" + 
                "<div class='float-center col-lg-6'>" + 
                "<a href='/guias/show/"+full.id+"' class='ver-guia' >" + 
                "<i class='fas fa-eye' title='Ver Guía'></i>" + 
                "</a>" + "</div>" +
                "<div class='float-center col-lg-6'>" + 
                "<a href='/guias/entrega/"+full.id+"' class='entrega-guia' >" + 
                "<i class='fas fa-hands-helping' title='Entregar Guía'></i>" + 
                "</a>" + "</div>";
            }
            
        },
        "responsivePriority": 5
    }]

});

//Confirmar Contraseña para borrar
$("#btnConfirmarAccion").click(function (event) {
    event.preventDefault();
    confirmarAccion();
});


function confirmarAccion(button) {
    $('.loader').fadeIn();
    var formData = $("#ConfirmarAccionForm").serialize();
    var id = $("#idConfirmacion").val();
    $.ajax({
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('#tokenReset').val() },
        url: APP_URL + "/oficinas/" + id + "/delete",
        data: formData,
        dataType: "json",
        success: function (data) {
            $('.loader').fadeOut(225);
            $('#modalConfirmarAccion').modal("hide");
            oficinas_table.ajax.reload();
            alertify.set('notifier', 'position', 'top-center');
            alertify.success('La Oficina se Desactivó Correctamente!!');
        },
        error: function (errors) {
            $('.loader').fadeOut(225);
            if (errors.responseText != "") {
                var errors = JSON.parse(errors.responseText);
                if (errors.password_actual != null) {
                    $("input[name='password_actual'] ").after("<label class='error' id='ErrorPassword_actual'>" + errors.password_actual + "</label>");
                }
                else {
                    $("#ErrorPassword_actual").remove();
                }
            }

        }

    });
}



$(document).on('click', 'a.activar-oficina', function(e) {
    e.preventDefault(); // does not go through with the link.

    var $this = $(this);    
    alertify.confirm('Activar Oficina', 'Esta seguro de activar la oficina', 
        function(){
            $('.loader').fadeIn();
            $.post({
                type: $this.data('method'),
                url: $this.attr('href')
            }).done(function (data) {
                $('.loader').fadeOut(225);
                    oficinas_table.ajax.reload();
                    alertify.set('notifier','position', 'top-center');
                    alertify.success('Oficina Activado con Éxito!!');
            }); 
         }
        , function(){
            alertify.set('notifier','position', 'top-center'); 
            alertify.error('Cancelar')
        });   
});

