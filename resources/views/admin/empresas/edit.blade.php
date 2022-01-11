@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Empresas
          <small>Editar Empresas</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('empresas.index')}}"><i class="fa fa-list"></i> Empresas</a></li>
          <li class="active">Actualizar</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="EmpresaEditForm"  action="{{route('empresas.update', $empresa)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8 {{$errors->has('nombre_empresa')? 'has-error' : ''}}">
                                <label for="nombre_empresa">Nombre:</label>
                                <input type="text" class="form-control" placeholder="Nombre" name="nombre_empresa" value="{{old('nombre_empresa', $empresa->nombre_empresa)}}">
                                {!!$errors->first('nombre_empresa', '<label class="error">:message</label>')!!}
                            </div>
                            <div class="col-sm-4 {{$errors->has('telefono_empresa')? 'has-error' : ''}}">
                                <label for="telefono_empresa">Teléfonos:</label>
                                <input type="text" class="form-control" placeholder="Teléfonos" name="telefono_empresa" value="{{old('telefono_empresa', $empresa->telefono_empresa)}}">
                                {!!$errors->first('telefono_empresa', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 {{$errors->has('direccion_empresa')? 'has-error' : ''}}">
                                <label for="direccion_empresa">Dirección:</label>
                                <input type="text" class="form-control" placeholder="Dirección" name="direccion_empresa" value="{{old('direccion_empresa', $empresa->direccion_empresa)}}">
                                {!!$errors->first('direccion_empresa', '<label class="error">:message</label>')!!}
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('empresas.index') }}">Regresar</a>
                            <button class="btn btn-success form-button" id="ButtonEmpresaUpdate">Guardar</button>
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
<script src="{{asset('js/empresas/edit.js')}}"></script>
@endpush