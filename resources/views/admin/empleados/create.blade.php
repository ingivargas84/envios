@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Empleados
          <small>Crear Empleados</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('empleados.index')}}"><i class="fa fa-list"></i>Empleados</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="EmpleadoForm"  action="{{route('empleados.save')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="nombre_empleado">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre:" name="nombre_empleado" >
                            </div>
                            <div class="col-sm-3">
                                <label for="cui_empleado">CUI / DPI</label>
                                <input type="text" class="form-control" placeholder="CUI / DPI:" name="cui_empleado" >
                            </div>
                            <div class="col-sm-3">
                                <label for="telefono_empleado">Teléfonos</label>
                                <input type="text" class="form-control" placeholder="Teléfonos:" name="telefono_empleado" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="direccion_empleado">Direccion</label>
                                <input type="text" class="form-control" placeholder="Dirección:" name="direccion_empleado" >
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('empleados.index') }}">Regresar</a>
                            <button class="btn btn-success form-button">Guardar</button>
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

<script src="{{asset('js/empleados/create.js')}}"></script>
@endpush