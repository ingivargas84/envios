@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Vehículos
          <small>Editar Vehículos</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('vehiculos.index')}}"><i class="fa fa-list"></i> Vehiculos</a></li>
          <li class="active">Actualizar</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="VehiculoEditForm"  action="{{route('vehiculos.update', $vehiculo)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4 {{$errors->has('no_placa')? 'has-error' : ''}}">
                                <label for="no_placa">No Placa:</label>
                                <input type="text" class="form-control" placeholder="No Placa" name="no_placa" value="{{old('no_placa', $vehiculo->no_placa)}}">
                                {!!$errors->first('no_placa', '<label class="error">:message</label>')!!}
                            </div>
                            <div class="col-sm-8 {{$errors->has('descripcion')? 'has-error' : ''}}">
                                <label for="descripcion">Descripción:</label>
                                <input type="text" class="form-control" placeholder="Descripción" name="descripcion" value="{{old('descripcion', $vehiculo->descripcion)}}">
                                {!!$errors->first('no_placa', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('vehiculos.index') }}">Regresar</a>
                            <button class="btn btn-success form-button" id="ButtonVehiculoUpdate">Guardar</button>
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
<script src="{{asset('js/vehiculos/edit.js')}}"></script>
@endpush