@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Entrega de Paquetes/Guías
          <small>Registrar Entrega</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('guias.index')}}"><i class="fa fa-list"></i>Guias</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="EntregaGuiaForm"  action="{{route('guias.saveentrega')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="no_guia">No Guía</label>
                                <input disabled type="text" class="form-control" name="no_guia" value="{{$oficina_origen[0]->cod_oficina}}-{{$guias[0]->no_guia}}-2021"  >
                                <input type="hidden" class="form-control" name="guia_id" id="guia_id" value="{{$guias[0]->id}}" >
                            </div>
                            <div class="col-sm-4">
                                <label for="cobro">Cobro</label>
                                <input disabled type="text" class="form-control" name="cobro" value="Q.{{ number_format((float) $guias[0]->total_flete, 2) }}; {{$tipo_cobro[0]->tipo_cobro}}" >
                            </div>
                            <div class="col-sm-4">
                                <label for="oficina_origen">Oficina Origen </label>
                                <input disabled type="text" class="form-control" name="oficina_origen" value="{{$oficina_origen[0]->nombre}}" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="contacto_envia">Contacto Envia</label>
                                <input disabled type="text" class="form-control" name="contacto_envia" value="{{$guias[0]->nombre_origen}} - {{$guias[0]->telefono_origen}}">
                            </div>
                            <div class="col-sm-6">
                                <label for="contacto_recibe">Contacto Recibe</label>
                                <input disabled type="text" class="form-control" name="contacto_recibe" value="{{$guias[0]->nombre_destino}} - {{$guias[0]->telefono_destino}}">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                 <label for="tipo_entrega_id">Tipo Entrega:</label>
                                <select name="tipo_entrega_id" id="tipo_entrega_id" class="form-control">
                                <option value="0"> - - Seleccione - -</option>
                                    @foreach ($tipo_entrega as $te)
                                        <option value="{{$te->id}}">{{$te->tipo_entrega}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="nombre_recibe">Persona que Recibe</label>
                                <input type="text" class="form-control" placeholder="Nombre de quien Recibe:" name="nombre_recibe" id="nombre_recibe">
                            </div>
                            <div class="col-sm-4">
                                <label for="dpi">DPI de quien Recibe</label>
                                <input type="text" class="form-control" placeholder="DPI:" name="dpi" dba_key_split="dpi" >
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="text-right m-t-15">
                                <a class='btn btn-primary form-button' href="{{ route('guias.index') }}">Regresar</a>
                                <button name="ButtonGuia" id="ButtonGuia" class="btn btn-success form-button">Entregar</button>
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

<script src="{{asset('js/guias/entrega.js')}}"></script>
@endpush