@extends('admin.layoutadmin')

@section('header')
    <section class="content-header">
        <h1>
          Guias
          <small>Crear Guias</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="{{route('dashboard')}}"><i class="fa fa-tachometer-alt"></i> Inicio</a></li>
          <li><a href="{{route('guias.index')}}"><i class="fa fa-list"></i>Guías</a></li>
          <li class="active">Crear</li>
        </ol>
    </section>
@stop

@section('content')
    <form id="GuiaShow">
            {{csrf_field()}}
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-body">

                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h2>No de Guía: <strong style="color:green">{{$oficina_origen[0]->cod_oficina}}-{{$guia_nueva[0]->no_guia}}-2021 </strong> </h2>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h4>Usuario que creo la guía: <strong>{{$usuario[0]->name}} </strong> </h4>
                            </div>                       
                        </div>
                        <div class="row">
                            <div class="col-sm-3 text-left">
                                <h4>Oficina Origen: <strong>{{$oficina_origen[0]->nombre}} </strong> </h4>
                            </div>
                            <div class="col-sm-3 text-center">
                                <h4>Oficina Destino: <strong>{{$oficina_destino[0]->nombre}} </strong> </h4>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h4>Destino: <strong>{{$destino[0]->destino}} </strong> </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <h4>Contacto Envía: <strong>{{$guia_nueva[0]->nombre_origen}} - {{$guia_nueva[0]->telefono_origen}} </strong> </h4>
                            </div>
                            <div class="col-sm-6 text-right">
                                <h4>Contacto Recibe: <strong>{{$guia_nueva[0]->nombre_destino}} - {{$guia_nueva[0]->telefono_destino}} </strong> </h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-left">
                                <h4>Descripción: <strong>{{$guia_nueva[0]->descripcion_contenido}} </strong> </h4>
                            </div>
                            <div class="col-sm-3 text-right">
                                <h4>Cobro: <strong>Q.{{ number_format((float) $guia_nueva[0]->total_flete, 2) }} {{$tipo_cobro[0]->tipo_cobro}} </strong> </h4>
                            </div>
                            <div class="col-sm-5 text-right">
                                <h4>Fecha Creación Guía: <strong>{{Carbon\Carbon::parse($guia_nueva[0]->created_at)->format('d-m-Y H:m:s')}} </strong> </h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-left">
                                @if ($guia_nueva[0]->empresa_id == 0)
                                    <h4>Envio Registrado: <strong>No hay registro de envío por empresa </strong> </h4>
                                @else
                                    <h4>Envio Registrado: <strong>{{$guia_nueva[0]->no_envio}} - {{$empresa[0]->nombre_empresa}} </strong> </h4>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @if ($guia_nueva[0]->fragil == 1) 
                                    <h2 style="color:red"><strong>FRÁGIL</strong> </h2>
                                @else
                                    <h2 style="color:green"><strong>NO FRÁGIL</strong> </h2>
                                @endif
                            </div>
                            <div class="col-sm-6 text-center">
                                @if ($guia_nueva[0]->estado_guia_id == 1) 
                                    <h2 style="color:green"><strong>En Oficina Origen</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 2)
                                    <h2 style="color:orange"><strong>En Ruta</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 3)
                                    <h2 style="color:green"><strong>En Oficina para Entrega</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 4)
                                    <h2 style="color:orange"><strong>En Bodega</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 5)
                                    <h2 style="color:green"><strong>Entregado</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 6)
                                    <h2 style="color:red"><strong>Rechazado</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 7)
                                    <h2 style="color:red"><strong>Devuelto</strong> </h2>
                                @elseif ($guia_nueva[0]->estado_guia_id == 8)
                                    <h2 style="color:red"><strong>En Ruta de Retorno</strong> </h2>
                                @endif
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-left">
                                @if ($guia_nueva[0]->estado_guia_id == 5) 
                                    <h5>Datos de Entrega: <strong>Recibió</strong> {{$entrega_guia[0]->nombre_recibe}} <strong> en </strong> {{$entrega_guia[0]->tipo_entrega}} <strong> el </strong> {{Carbon\Carbon::parse($entrega_guia[0]->created_at)->format('d-m-Y H:m:s')}}  </h5>
                                @else
                                    <h5>Datos de Entrega: <strong>Los paquetes aún no se han entregado. </strong> </h5>
                                @endif
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 text-left">
                                <h4><strong><u> CONTENIDO </u></strong></h4>
                            </div>
                        </div>
                        <table border="1" cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width=25% style="font-size:15px; text-align:center;">Cantidad</th>
                                <th width=25% style="font-size:15px; text-align:center;">Tipo Paquete</th>
                                <th width=50% style="font-size:15px; text-align:left;">Descripción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guia_detalle as $gd)
                            <tr>
                                <td style="font-size:13px; text-align:center;">{{ $gd->cantidad }}</td>
                                <td style="font-size:13px; text-align:center;">{{ $gd->tipo_paquete }}</td>
                                <td style="font-size:13px; text-align:left;">{{ $gd->descripcion}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-12 text-left">
                                <h4><strong>Total:</strong> {{$suma[0]->total}} Bultos </h4>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12 text-left">
                                <h4><strong><u> Movimientos de la Guía </u></strong></h4>
                            </div>
                        </div>
                        <table border="1" cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th width=30% style="font-size:15px; text-align:center;">Estado</th>
                                <th width=30% style="font-size:15px; text-align:center;">Usuario que Registra</th>
                                <th width=30% style="font-size:15px; text-align:left;">Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($movimientos_guia as $mg)
                            <tr>
                                <td style="font-size:13px; text-align:center;">{{ $mg->estado_guia }}</td>
                                <td style="font-size:13px; text-align:center;">{{ $mg->name }}</td>
                                <td style="font-size:13px; text-align:left;">{{Carbon\Carbon::parse($mg->created_at)->format('d-m-Y H:m:s')}}</td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                        </table>
                        <div class="text-right m-t-15">
                            <a class='btn btn-primary form-button' href="{{ route('guias.index') }}">Regresar</a>
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

@endpush