@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Oficinas
          <small>Crear Oficinas</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('oficinas.index')}}"><i class="fa fa-list"></i>Oficinas</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="OficinaForm"  action="{{route('oficinas.save')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" placeholder="Nombre:" name="nombre" >
                            </div>
                            <div class="col-sm-4">
                                <label for="cod_oficina">Código Oficina</label>
                                <input type="text" class="form-control" placeholder="Código Oficina:" name="cod_oficina" >
                            </div>
                            <div class="col-sm-4">
                                <label for="telefonos">Teléfonos</label>
                                <input type="text" class="form-control" placeholder="Teléfonos:" name="telefonos" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="direccion">Direccion</label>
                                <input type="text" class="form-control" placeholder="Dirección:" name="direccion" >
                            </div>
                        </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('oficinas.index') }}">Regresar</a>
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

<script src="{{asset('js/oficinas/create.js')}}"></script>
@endpush