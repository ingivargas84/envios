@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Gestión de Guias
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('guias.index')}}"><i class="fa fa-list"></i>Guías</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form method="POST" id="GuiaForm" action="{{route('guias.save')}}">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="row">
                        <div class="col-sm-4">
                            <label for="vehiculo_id">Vehículo:</label>
                                <select name="vehiculo_id" class="form-control">
                                <option value="default"> - - Seleccione - -</option>
                                    @foreach ($vehiculos as $ve)
                                        <option value="{{$ve->id}}">{{$ve->no_placa}}-{{$ve->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                            <label for="piloto_id">Piloto:</label>
                                <select name="piloto_id" class="form-control">
                                <option value="default"> - - Seleccione - -</option>
                                    @foreach ($empleados as $pil)
                                        <option value="{{$pil->id}}">{{$pil->nombre_empleado}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="oficina_recibe_id">Oficina Recibe:</label>
                                <select name="oficina_recibe_id" class="form-control">
                                <option value="default"> - - Seleccione - -</option>
                                    @foreach ($oficinas as $ofr)
                                        <option value="{{$ofr->id}}">{{$ofr->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-4">
                                <label for="oficina_envia_id">Oficina Envia:</label>
                                <select name="oficina_envia_id" class="form-control">
                                <option value="default"> - - Seleccione - -</option>
                                    @foreach ($oficinas as $ofe)
                                        <option value="{{$ofe->id}}">{{$ofe->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label for="oficina_id">Guías/Envíos Disponibles:</label>
                                <select name="oficina_id" class="form-control">
                                <option value="default"> - - Seleccione - -</option>
                                    @foreach ($guias as $g)
                                        <option value="{{$g->id}}">{{$g->id}} - {{$g->nombre_origen}} - {{$g->nombre_destino}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <div class="text-right m-t-15" style="margin-top: 15px; margin-bottom: 10px">
                                    <button id="agregar-detalle-guia" class="btn btn-success form-button" tabindex="11">Agregar al detalle</button>
                            </div>
                    </div>
                            
                        </div>
                <br>
                <table id="detalle-table-guia" class="table table-striped table-bordered no-margin-bottom dt-responsive nowrap" width="100%">
                </table>
                <br>
                <div class="row">
                    <div class="col-sm-4">
                        <label for="total_ingreso">Total Cobrado:</label>
                        <div class="input-group">
                            <span class="input-group-addon">Q.</span>
                            <input type="text" class="form-control customreadonly" placeholder="Total Enviado Q." name="total_enviado" id="total">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="total_ingreso">Total por Cobrar:</label>
                        <div class="input-group">
                            <span class="input-group-addon">Q.</span>
                            <input type="text" class="form-control customreadonly" placeholder="Total Enviado Q." name="total_enviado" id="total">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <label for="total_ingreso">Total Enviado:</label>
                        <div class="input-group">
                            <span class="input-group-addon">Q.</span>
                            <input type="text" class="form-control customreadonly" placeholder="Total Enviado Q." name="total_enviado" id="total">
                        </div>
                    </div>
                </div>
                        <br>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('guias.index') }}">Regresar</a>
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

<script src="{{asset('js/guias/gestion.js')}}"></script>
@endpush