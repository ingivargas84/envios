@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Envíos
          <small>Crear Envío</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('envios.index')}}"><i class="fa fa-list"></i>Envíos</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="EnvioForm"  action="{{route('envios.save')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label for="oficina_envia_id">Oficina Origen:</label>
                                <select name="oficina_envia_id" class="form-control" id="oficina_envia_id" tabindex="1">
                                    <option value="default">Seleccione Oficina Origen</option>
                                    @foreach ($oficina as $oo)
                                    <option value="{{$oo->id}}">{{$oo->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="oficina_recibe_id">Oficina Destino:</label>
                                <select name="oficina_recibe_id" class="form-control" id="oficina_recibe_id" tabindex="2">
                                    <option value="default">Seleccione Oficina Destino</option>
                                    @foreach ($oficina as $od)
                                    <option value="{{$od->id}}">{{$od->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="vehiculo_id">Vehículo:</label>
                                <select name="vehiculo_id" class="form-control" id="vehiculo_id" tabindex="3">
                                    <option value="default">Seleccione el Vehículo</option>
                                    @foreach ($vehiculos as $ve)
                                    <option value="{{$ve->id}}">{{$ve->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="piloto_id">Piloto:</label>
                                <select name="piloto_id" class="form-control" id="piloto_id" tabindex="4">
                                    <option value="default">Seleccione el Piloto</option>
                                    @foreach ($pilotos as $pil)
                                    <option value="{{$pil->id}}">{{$pil->nombre_empleado}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 col-sm-6">
                                <label for="guia_id">Guías:</label>
                                <select name="guia_id" class="form-control" id="guia_id" tabindex="5">
                                    <option value="default">Seleccione una Guía</option>
                                    @foreach ($guias as $g)
                                    <option value="{{$g->id}}">{{$g->no_guia}} - {{$g->nombre_origen}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="tipo_guia">Tipo de Guía:</label>
                                <input type="text" class="form-control" placeholder="Tipo de Guía" name="tipo_guia" id="tipo_guia" disabled tabindex="6">
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="no_guia">No de Guía:</label>
                                <input type="text" class="form-control" placeholder="No de Guía" name="no_guia" id="no_guia" disabled tabindex="7">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-3 col-sm-3">
                                <label for="nombre_origen">Envia:</label>
                                <input type="text" class="form-control" placeholder="Nombre Origen" name="nombre_origen" id="nombre_origen" disabled tabindex="8">
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="nombre_destino">Recibe:</label>
                                <input type="text" class="form-control" placeholder="Nombre Destino" name="nombre_destino" id="nombre_destino" disabled tabindex="9">
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="paquetes">Paquetes:</label>
                                <input type="text" class="form-control" placeholder="Paquetes" name="paquetes" id="paquetes" disabled tabindex="10">
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <label for="total">Total:</label>
                                <input type="number" class="form-control" placeholder="Cobro" name="total" id="total" disabled tabindex="11">
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <input  type="hidden" class="form-control" name="tipo_cobro" id="tipo_cobro" disabled tabindex="12">
                                <input  type="hidden" class="form-control" name="id_guia" id="id_guia" disabled tabindex="13">
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
                        </div>
                        <br>
                        <table id="detalle-table" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" width="100%">
                        </table>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('envios.index') }}">Regresar</a>
                            <button id="ButtonEnvio" class="btn btn-success form-button">Guardar</button>
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

    $("#guia_id").change(function () {
	var guia_id = $("#guia_id").val();
	var url = "/envios/getGuia/" + guia_id ;
	if (guia_id != "") {
		$.getJSON( url , function ( result ) {
			$("input[name='tipo_guia'] ").val(result[0].tipo_guia);
            $("input[name='no_guia'] ").val(result[0].no_guia);
            $("input[name='nombre_origen'] ").val(result[0].nombre_origen);
            $("input[name='nombre_destino'] ").val(result[0].nombre_destino);
            $("input[name='paquetes'] ").val(result[0].descripcion_contenido);
            $("input[name='total'] ").val(result[0].total_flete);
            $("input[name='tipo_cobro'] ").val(result[0].tipo_cobro_id);
            $("input[name='id_guia'] ").val(result[0].id);
		});
	}
    });


    function chkflds() {
        if ($('#no_guia').val() && $('#total').val()) {
            return true
        } else {
            return false
        }
    }


    $('#agregar-detalle').click(function(e) {
        e.preventDefault();
        if (chkflds()) {
            
            detalle_table.row.add({
                'id': $('#id_guia').val(),
                'no_guia': $('#no_guia').val(),
                'envia': $('#nombre_origen').val(),
                'recibe': $('#nombre_destino').val(),
                'tipo_cobro': $('#tipo_cobro').val(),
                'total_flete': $('#total').val()
            }).draw();
            

            $('#guia_id').val('default');
            $('#id_guia').val(null);
            $('#nombre_origen').val(null);
            $('#nombre_destino').val(null);
            $('#paquetes').val(null);
            $('#total').val(null);
            $('#tipo_guia').val(null);
            $('#no_guia').val(null);
            $('#tipo_cobro').val(null);
        } else {
            alertify.set('notifier', 'position', 'top-center');
            alertify.error('Debe seleccionar una guía')
        }
    });



    $(document).on('click', '#ButtonEnvio', function(e) {
        e.preventDefault();
        if ($('#EnvioForm').valid()) {
            var arr1 = $('#EnvioForm').serializeArray();
            var arr2 = detalle_table.rows().data().toArray();
            var arr3 = arr1.concat(arr2);

            $.ajax({
                type: 'POST',
                url: "{{route('envios.save')}}",
                headers: {
                    'X-CSRF-TOKEN': $('#tokenReset').val(), 
                },
                data: JSON.stringify(arr3), 
                dataType: 'json',
                success: function() {
                    $('#id_guia').val(null);
                    $('#nombre_origen').val(null);
                    $('#oficina_envia_id').val('default');
                    $('#oficina_destino_id').val('default');
                    $('#vehiculo_id').val('default');
                    $('#piloto_id').val('default');
                    $('#nombre_destino').val(null);
                    $('#guia_id').val('default');
                    $('#paquetes').val(null);
                    $('#total').val(null);
                    $('#no_guia').val(null);
                    $('#tipo_cobro').val(null);
                    detalle_table.rows().remove().draw();
                    window.location.assign('/envios')
                },
                error: function() {
                    alertify.set('notifier', 'position', 'top-center');
                    alertify.error('Hubo un error al registrar el envio')
                }
            })
        }
    });

</script>

<script src="{{asset('js/envios/detalle.js')}}"></script>
<script src="{{asset('js/envios/create.js')}}"></script>
@endpush