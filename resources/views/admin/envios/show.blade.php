@extends('admin.layoutadmin')

@section('header')
<section class="content-header">
    <h1>
        Envío
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
        <li><a href="{{route('envios.index')}}"><i class="fa fa-list"></i> Envios</a></li>
        <li class="active">Ver</li>
    </ol>
</section>
@stop

@section('content')
<form id="EnviosForm">
    {{csrf_field()}}
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 text-center">
                        <h2><strong>Información del Envío</strong></h2>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>No del Envío:</strong> {{$enviomaestro[0]->id}} </h4>
                    </div>
                    <div class="col-md-4 col-sm-4">
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Fecha del Envío:</strong>{{Carbon\Carbon::parse($enviomaestro[0]->created_at)->format('d-m-Y')}}</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Oficina Origen:</strong> {{$enviomaestro[0]->oficina_envia}} </h4>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Oficina Destino:</strong> {{$enviomaestro[0]->oficina_recibe}} </h4>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Vehículo:</strong> {{$enviomaestro[0]->vehiculo}} </h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Piloto:</strong> {{$enviomaestro[0]->piloto}} </h4>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Total Cobrado:</strong> Q. {{{number_format((float) $enviomaestro[0]->total_cobrado, 2) }}}</h4>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Total por Cobrar:</strong> Q. {{{number_format((float) $enviomaestro[0]->total_por_cobrar, 2) }}}</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <h4><strong>Total del Envío:</strong> Q. {{{number_format((float) $enviomaestro[0]->total_enviado, 2) }}} </h4>
                    </div>
                    <div class="col-md-2 col-sm-2">
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <h4><strong>Usuario Crea Envío:</strong> {{$enviomaestro[0]->name}} </h4>
                    </div>
                </div>
                <br>
                <table border="1" cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width=10% style="font-size:15px; text-align:center;">No de Guía</th>
                                <th width=15% style="font-size:15px; text-align:center;">Envia</th>
                                <th width=15% style="font-size:15px; text-align:center;">Recibe</th>
                                <th width=15% style="font-size:15px; text-align:center;">Tipo Cobro</th>
                                <th width=15% style="font-size:15px; text-align:right;">Total Guía</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enviodetalle as $ed)
                            <tr>
                                <td style="font-size:13px; text-align:center;">{{$ed->no_guia}}</td>
                                <td style="font-size:13px; text-align:center;">{{ $ed->nombre_origen }}</td>
                                <td style="font-size:13px; text-align:center;">{{ $ed->nombre_destino }}</td>
                                <td style="font-size:13px; text-align:center;">{{ $ed->tipo_cobro }}</td>
                                <td style="font-size:13px; text-align:right;">Q. {{{number_format((float) $ed->total_flete, 2) }}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                <br>
                <h4>Total y Detalle de Bultos</h4>
                <table border="1" cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width=20% style="font-size:15px; text-align:center;">Cantidad</th>
                                <th width=50% style="font-size:15px; text-align:center;">Paquete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($paquetes as $paq)
                            <tr>
                                <td style="font-size:13px; text-align:center;">{{$paq->total}}</td>
                                <td style="font-size:13px; text-align:center;">{{ $paq->tipo_paquete }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
                
                <div class="text-right m-t-15">
                    <a class='btn btn-primary form-button' href="{{ route('envios.index') }}">Regresar</a>
                </div>
                
            </div>
        </div>
    </div>
</form>
<div class="loader loader-bar"></div>
@stop


@push('styles')

@endpush
