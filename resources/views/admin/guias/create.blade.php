@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Guias
          <small>Crear Guias</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('guias.index')}}"><i class="fa fa-list"></i>Guías</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="GuiaForm"  action="{{route('guias.save')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tipo_guia">Tipo Guia:</label>
                                <select name="tipo_guia" id="tipo_guia" class="form-control">
                                    <option value="1"> Automática</option>
                                    <option value="2"> Manual</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="nombre_destino">Numero Guía</label>
                                <input type="text" class="form-control" placeholder="No Guía:" id="no_guia" name="no_guia" value="{{$guia}}" >
                            </div>
                            <div class="col-sm-3">
                                <label for="oficina_origen_id">Oficina Recibe:</label>
                                <select name="oficina_origen_id" id="oficina_origen_id" class="form-control">
                                <option value="default"> - - Seleccione - -</option>
                                    @foreach ($oficinas as $of)
                                        <option value="{{$of->id}}">{{$of->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="oficina_destino_id">Oficina Destino:</label>
                                <select name="oficina_destino_id" id="oficina_destino_id" class="form-control">
                                <option value="0"> - - Seleccione - -</option>
                                    @foreach ($oficinas as $of)
                                        <option value="{{$of->id}}">{{$of->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nombre_origen">Nombre Origen</label>
                                <input type="text" class="form-control" placeholder="Nombre Origen:" id="nombre_origen" name="nombre_origen" >
                            </div>
                            <div class="col-sm-4">
                                <label for="telefono_origen">Teléfonos Origen</label>
                                <input type="text" class="form-control" placeholder="Telefono Origen:" id="telefono_origen" name="telefono_origen" >
                            </div>
                            <div class="col-sm-4">
                                <label for="fragil">Frágil:</label>
                                <select name="fragil" id="fragil" class="form-control">
                                    <option value="2"> No es Frágil</option>
                                    <option value="1"> Si es Frágil</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nombre_destino">Nombre Destino</label>
                                <input type="text" class="form-control" placeholder="Nombre Destino:" id="nombre_destino" name="nombre_destino" >
                            </div>
                            <div class="col-sm-4">
                                <label for="telefono_destino">Teléfonos Destino</label>
                                <input type="text" class="form-control" placeholder="Telefono Destino:" id="telefono_destino" name="telefono_destino" >
                            </div>
                            <div class="col-sm-4">
                            <label for="destino_id">Dirección Destino:</label>
                                <select id="destino_id" name="destino_id" class="form-control">
                                <option value="0"> - - Seleccione - -</option>
                                    @foreach ($destinos as $ds)
                                        <option value="{{$ds->id}}">{{$ds->destino}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="descripcion_contenido">Descripción del Contenido</label>
                                <input type="text" class="form-control" placeholder="Descripción Contenido:" id="descripcion_contenido" name="descripcion_contenido" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tipo_cobro_id">Tipo de Cobro:</label>
                                <select name="tipo_cobro_id" id="tipo_cobro_id" class="form-control">
                                <option value="0"> - - Seleccione - -</option>
                                    @foreach ($tipo_cobro as $tc)
                                        <option value="{{$tc->id}}">{{$tc->tipo_cobro}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="total_flete">Total Flete Q.</label>
                                <input type="text" class="form-control" placeholder="Total Flete Q.:" id="total_flete" name="total_flete" >
                            </div>
                            <div class="col-sm-3">
                                <label for="no_envio">No Envio</label>
                                <input type="text" class="form-control" placeholder="No Envio" id="no_envio" name="no_envio" value="0">
                            </div>
                            <div class="col-sm-3">
                                <label for="empresa_id">Empresa:</label>
                                <select name="empresa_id" id="empresa_id" class="form-control">
                                <option value="0"> - - Seleccione - -</option>
                                    @foreach ($empresa as $emp)
                                        <option value="{{$emp->id}}">{{$emp->nombre_empresa}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="cantidad_contenido">Cantidad</label>
                                <input type="text" class="form-control" placeholder="Cantidad:" id="cantidad_contenido" name="cantidad_contenido" >
                            </div>
                            <div class="col-sm-3">
                                <label for="tipo_paquete_id">Tipo de Paquete:</label>
                                <select name="tipo_paquete_id" id="tipo_paquete_id" class="form-control">
                                <option value="0"> - - Seleccione - -</option>
                                    @foreach ($tipo_paquete as $tp)
                                        <option value="{{$tp->id}}">{{$tp->tipo_paquete}}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" class="form-control" id="paquete" name="paquete" >
                            </div>
                            <div class="col-sm-6">
                                <label for="descripcion_detalle">Descripcion</label>
                                <input type="text" class="form-control" placeholder="Descripcion:" id="descripcion_detalle" name="descripcion_detalle" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="text-left m-t-15">
                                    <h3>Detalle</h3>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-right m-t-15" style="margin-top: 15px; margin-bottom: 10px">
                                    <button id="agregar-detalle" class="btn btn-success form-button">Agregar al detalle</button>
                            </div>
                        </div>
                        <br>
                        <table id="detalle-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" width="100%">
                        </table>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('guias.index') }}">Regresar</a>
                            <button id="ButtonGuia" class="btn btn-success form-button">Guardar</button>
                        </div>
                                    
                    </div>
                </div>                
            </div>
    </form>
    <div class="loader loader-bar"></div>

    @stop


@push('styles')

<style>
    div.col-md-6 {
        margin-bottom: 15px;
    }

    .customreadonly {
        background-color: #eee;
        cursor: not-allowed;
        pointer-events: none;
    }

    .switch-field {
        display: flex;
        margin-bottom: 20px;
        overflow: hidden;
    }

    .switch-field input {
        position: absolute !important;
        clip: rect(0, 0, 0, 0);
        height: 1px;
        width: 1px;
        border: 0;
        overflow: hidden;
    }

    .switch-field label {
        background-color: #e4e4e4;
        color: rgba(0, 0, 0, 0.6);
        font-size: 14px;
        line-height: 1;
        text-align: center;
        padding: 8px 16px;
        margin-right: -1px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.3), 0 1px rgba(255, 255, 255, 0.1);
        transition: all 0.1s ease-in-out;
        width: 50%
    }

    .switch-field label:hover {
        cursor: pointer;
    }

    .switch-field input:checked+label {
        background-color: #55bd8c;
        box-shadow: none;
    }

    .switch-field label:first-of-type {
        border-radius: 4px 0 0 4px;
    }

    .switch-field label:last-of-type {
        border-radius: 0 4px 4px 0;
    }

</style>

@endpush

@push('scripts')

<script>


    $("#tipo_paquete_id").change(function () {
	var tipo_paquete_id = $("#tipo_paquete_id").val();
	var url = "/guias/getPaquete/" + tipo_paquete_id ;
	if (tipo_paquete_id != "") {
		$.getJSON( url , function ( result ) {
			$("input[name='paquete'] ").val(result[0].tipo_paquete);
		});
	}
    });

    function chkflds() {
        if ($('#cantidad_contenido').val()) {
            return true
        } else {
            return false
        }
    }

    $('#agregar-detalle').click(function(e) {
        e.preventDefault();
        if (chkflds()) {

            detalle_table.row.add({
                'tipo_paquete_id': $('#tipo_paquete_id').val(),
                'tipo_paquete': $('#paquete').val(),
                'cantidad_contenido': $('#cantidad_contenido').val(),
                'descripcion_detalle': $('#descripcion_detalle').val()
            }).draw();
            //adds all subtotal row data and sets the total input

            //resets form data
            $('#tipo_paquete_id').val('0');
            $('#paquete').val(null);
            $('#cantidad_contenido').val(null);
            $('#descripcion_detalle').val(null);
        } else {
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('Debe ingresar una cantidad, selecciona un paquete o ingresar una descripción')
        }
    });



    $(document).on('click', '#ButtonGuia', function(e) {
        e.preventDefault();
        if ($('#GuiaForm').valid()) {
            var arr1 = $('#GuiaForm').serializeArray();
            var arr2 = detalle_table.rows().data().toArray();
            var arr3 = arr1.concat(arr2);

            $.ajax({
                type: 'POST',
                url: "{{route('guias.save')}}",
                headers: {
                    'X-CSRF-TOKEN': $('#tokenReset').val(), 
                },
                data: JSON.stringify(arr3), 
                dataType: 'json',
                success: function() {
                    $('#tipo_guia').val('1');
                    $('#no_guia').val(null);
                    $('#oficina_origen_id').val('0');
                    $('#oficina_destino_id').val('0');
                    $('#nombre_origen').val(null);
                    $('#telefono_origen').val(null);
                    $('#fragil').val('2');
                    $('#nombre_destino').val(null);
                    $('#telefono_destino').val(null);
                    $('#destino_id').val('0');
                    $('#descripcion_contenido').val(null);
                    $('#tipo_cobro_id').val('0');
                    $('#total_flete').val(null);
                    $('#no_envio').val(null);
                    $('#empresa_id').val('0');
                    $('#cantidad_contenido').val(null);
                    $('#tipo_paquete_id').val('0');
                    $('#descripcion_detalle').val(null);
                    detalle_table.rows().remove().draw();
                    window.location.assign('/guias')
                },
                error: function() {
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.error('Hubo un error al registrar la guia')
                }
            })
        }
    });

</script>

<script src="{{asset('js/guias/detalle.js')}}"></script>{{-- datatable --}}
<script src="{{asset('js/guias/create.js')}}"></script>{{-- validator --}}
@endpush
