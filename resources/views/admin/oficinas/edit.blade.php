@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Oficinas
          <small>Editar Oficinas</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('oficinas.index')}}"><i class="fa fa-list"></i> Oficinas</a></li>
          <li class="active">Actualizar</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="OficinaEditForm"  action="{{route('oficinas.update', $oficina)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4 {{$errors->has('nombre')? 'has-error' : ''}}">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre" value="{{old('nombre', $oficina->nombre)}}">
                                {!!$errors->first('nombre', '<label class="error">:message</label>')!!}
                            </div>
                            <div class="col-sm-8 {{$errors->has('telefonos')? 'has-error' : ''}}">
                                <label for="telefonos">Teléfonos:</label>
                                <input type="text" class="form-control" placeholder="Teléfonos" name="telefonos" value="{{old('telefonos', $oficina->telefonos)}}">
                                {!!$errors->first('telefonos', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 {{$errors->has('direccion')? 'has-error' : ''}}">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" placeholder="Dirección" name="direccion" value="{{old('direccion', $oficina->direccion)}}">
                                {!!$errors->first('direccion', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('oficinas.index') }}">Regresar</a>
                            <button class="btn btn-success form-button" id="ButtonOficinaUpdate">Guardar</button>
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
<script src="{{asset('js/oficinas/edit.js')}}"></script>
@endpush