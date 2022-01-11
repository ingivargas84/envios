@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Datos de la Guía
          <small>Editar Guía</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('guias.index')}}"><i class="fa fa-list"></i> Guías</a></li>
          <li class="active">Actualizar</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="GuiaEditForm"  action="{{route('guias.update', $guia)}}">
            {{csrf_field()}}
            {{ method_field('PUT') }}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="no_guia">Numero Guía</label>
                                <input disabled type="text" class="form-control" placeholder="No Guía:" id="no_guia" name="no_guia" value="{{old('no_guia', $guia->no_guia)}}" >
                            </div>
                            <div class="col-sm-4">
                                <label for="oficina_origen_id">Oficina Recibe</label>
                                <select name="oficina_origen_id" id="oficina_origen_id" class="form-control">
                                        <option value="0"> - - Seleccione - -</option>
                                        @foreach ($oficinas as $of)
                                            @if ($of->id == $guia->oficina_origen_id)
                                                <option value="{{$of->id}}" selected >{{$of->nombre}}</option>
                                            @else
                                                <option value="{{$of->id}}">{{$of->nombre}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="oficina_destino_id">Oficina Destino</label>
                                <select name="oficina_destino_id" id="oficina_destino_id" class="form-control">
                                        <option value="0"> - - Seleccione - -</option>
                                        @foreach ($oficinas as $of)
                                            @if ($of->id == $guia->oficina_destino_id)
                                                <option value="{{$of->id}}" selected >{{$of->nombre}}</option>
                                            @else
                                                <option value="{{$of->id}}">{{$of->nombre}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="nombre_origen">Nombre Origen</label>
                                <input type="text" class="form-control" placeholder="Nombre Origen:" id="nombre_origen" name="nombre_origen" value="{{old('nombre_origen', $guia->nombre_origen)}}">
                            </div>
                            <div class="col-sm-4">
                                <label for="telefono_origen">Teléfonos Origen</label>
                                <input type="text" class="form-control" placeholder="Telefono Origen:" id="telefono_origen" name="telefono_origen" value="{{old('telefono_origen', $guia->telefono_origen)}}">
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
                                <input type="text" class="form-control" placeholder="Nombre Destino:" id="nombre_destino" name="nombre_destino" value="{{old('nombre_destino', $guia->nombre_destino)}}">
                            </div>
                            <div class="col-sm-4">
                                <label for="telefono_destino">Teléfonos Destino</label>
                                <input type="text" class="form-control" placeholder="Telefono Destino:" id="telefono_destino" name="telefono_destino" value="{{old('telefono_destino', $guia->telefono_destino)}}">
                            </div>
                            <div class="col-sm-4">
                                <label for="destino_id">Dirección Destino</label>
                                <select name="destino_id" id="destino_id" class="form-control">
                                        <option value="0"> - - Seleccione - -</option>
                                        @foreach ($destinos as $ds)
                                            @if ($ds->id == $guia->destino_id)
                                                <option value="{{$ds->id}}" selected >{{$ds->destino}}</option>
                                            @else
                                                <option value="{{$ds->id}}">{{$ds->destino}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <label for="descripcion_contenido">Descripción del Contenido</label>
                                <input type="text" class="form-control" placeholder="Descripción Contenido:" id="descripcion_contenido" name="descripcion_contenido" value="{{old('descripcion_contenido', $guia->descripcion_contenido)}}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="tipo_cobro_id">Tipo de Cobro</label>
                                <select name="tipo_cobro_id" id="tipo_cobro_id" class="form-control">
                                        <option value="0"> - - Seleccione - -</option>
                                        @foreach ($tipo_cobro as $tc)
                                            @if ($tc->id == $guia->tipo_cobro_id)
                                                <option value="{{$tc->id}}" selected >{{$tc->tipo_cobro}}</option>
                                            @else
                                                <option value="{{$tc->id}}">{{$tc->tipo_cobro}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label for="total_flete">Total Flete Q.</label>
                                <input type="text" class="form-control" placeholder="Total Flete Q.:" id="total_flete" name="total_flete" value="{{old('total_flete', $guia->total_flete)}}">
                            </div>
                            <div class="col-sm-3">
                                <label for="no_envio">No Envio</label>
                                <input type="text" class="form-control" placeholder="No Envio" id="no_envio" name="no_envio" value="0" value="{{old('no_envio', $guia->no_envio)}}">
                            </div>
                            <div class="col-sm-3">
                                <label for="empresa_id">Empresa</label>
                                <select name="empresa_id" id="empresa_id" class="form-control">
                                        <option value="0"> - - Seleccione - -</option>
                                        @foreach ($empresa as $emp)
                                            @if ($emp->id == $guia->empresa_id)
                                                <option value="{{$emp->id}}" selected >{{$emp->nombre_empresa}}</option>
                                            @else
                                                <option value="{{$emp->id}}">{{$emp->nombre_empresa}}</option>
                                            @endif
                                        @endforeach
                                </select>
                            </div>
                        </div>




                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('guias.index') }}">Regresar</a>
                            <button class="btn btn-success form-button" id="ButtonGuiaUpdate">Guardar</button>
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