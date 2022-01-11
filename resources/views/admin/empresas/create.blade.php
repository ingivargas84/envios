@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Empresas
          <small>Crear Empresas</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('empresas.index')}}"><i class="fa fa-list"></i>Empresas</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="EmpresaForm"  action="{{route('empresas.save')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <label for="nombre_empresa">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre:" name="nombre_empresa" >
                            </div>
                            <div class="col-sm-4">
                                <label for="telefono_empresa">Teléfonos</label>
                                <input type="text" class="form-control" placeholder="Teléfonos:" name="telefono_empresa" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="direccion_empresa">Direccion</label>
                                <input type="text" class="form-control" placeholder="Dirección:" name="direccion_empresa" >
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('empresas.index') }}">Regresar</a>
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

<script src="{{asset('js/empresas/create.js')}}"></script>
@endpush