@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
            Crear Reporte de Guías de Transporte por Fecha
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('guias.index')}}"><i class="fa fa-list"></i>Guías</a></li>
          <li class="active">Reporte</li>
        </ol>
    </section>
@stop

@section('content')
    <form id="RptGuiaForm" >
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="fecha_guias">Fecha Guias</label>
                                <div class="input-group date" id='fecha_guias'>
                                    <input type="text" class='form-control clsDatePicker' id="fehca_guias" name='fecha_guias'>
                                    <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>    
                        <div class="row">
                            <div class="col-sm-3">
                                <a class='btn btn-primary form-button' href="{{ route('guias.index') }}">Regresar</a>
                                <a class='btn btn-success form-button' target="_blank" href="{{ route('reportes.guias_fecha') }}">Generar Reporte</a>
                            </div>
                        </div> 
                    </div>
                </div>                
            </div>
    </form>
    <div class="loader loader-bar"></div>

@stop


@push('styles')

@endpush


@push('scripts')

<script>

    $('#fecha_guias').datepicker({
        "language": "es",
        "todayHighlight": true,
        "clearBtn": true,
        "autoclose": true,
        "format": "dd-mm-yyyy"
    });


</script>
@endpush