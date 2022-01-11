@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Empleados
          <small>Editar Empleados</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('empleados.index')}}"><i class="fa fa-list"></i> Empleados</a></li>
          <li class="active">Actualizar</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="EmpleadoEditForm"  action="{{route('empleados.update', $empleado)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 {{$errors->has('nombre_empleado')? 'has-error' : ''}}">
                                <label for="nombre_empleado">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre_empleado" value="{{old('nombre_empleado', $empleado->nombre_empleado)}}">
                                {!!$errors->first('nombre_empleado', '<label class="error">:message</label>')!!}
                            </div>
                            <div class="col-sm-3 {{$errors->has('cui_empleado')? 'has-error' : ''}}">
                                <label for="cui_empleado">CUI / DPI:</label>
                                <input type="text" class="form-control" placeholder="CUI / DPI" name="cui_empleado" value="{{old('cui_empleado', $empleado->cui_empleado)}}">
                                {!!$errors->first('cui_empleado', '<label class="error">:message</label>')!!}
                            </div>
                            <div class="col-sm-3 {{$errors->has('telefono_empleado')? 'has-error' : ''}}">
                                <label for="telefono_empleado">Teléfonos:</label>
                                <input type="text" class="form-control" placeholder="Teléfonos" name="telefono_empleado" value="{{old('telefono_empleado', $empleado->telefono_empleado)}}">
                                {!!$errors->first('telefono_empleado', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 {{$errors->has('direccion_empleado')? 'has-error' : ''}}">
                                <label for="direccion_empleado">Dirección:</label>
                                <input type="text" class="form-control" placeholder="Dirección" name="direccion_empleado" value="{{old('direccion_empleado', $empleado->direccion_empleado)}}">
                                {!!$errors->first('direccion_empleado', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('empleados.index') }}">Regresar</a>
                            <button class="btn btn-success form-button" id="ButtonEmpleadoUpdate">Guardar</button>
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
<script src="{{asset('js/empleados/edit.js')}}"></script>
@endpush