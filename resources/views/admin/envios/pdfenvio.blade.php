<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Envío de Guías</title>
    <link rel="stylesheet" type="text/css" href="/public/style.css">
    <style>
        .table {
            width: 700px;
            height: auto;
        }
        th {
            background-color: gray;
            color: white;
        }
        table {
            border-collapse: collapse;
            border: 0px solid black;
        }
                
    </style>
</head>
<body>
    <div class="container">
       <div class="row">
        <div class="col-md-12">

        <table class="table table-striped table-bordered" border="1" cellspadding=2>
            <tr>
                <td style="width:65%; text-align:center; font-size:25px" colspan=2><strong>TRANSPORTES ORELLANA</strong></td>
                <td style="width:35%; text-align:right;"><img src="images/logo1.jpg"></td>
            </tr>
            <tr>        
                <td style="width:35%; text-align:center; font-size:12px">Oficina 21 calle, entre 11 y 12 Av, Zona 1, Guatemala - Tels: 2232-8434 | 5137-5112 | 5016-4454</td>
                <td style="width:30%; text-align:center; font-size:12px">Oficina Centra Norte, Local 24, Guatemala - Tel: 5137-5112</td>
                <td style="width:35%; text-align:center; font-size:12px">Hotel y Turicentro Paola, Guastatoya, El Progreso - Tels: 7945-2070 | 5692-9463</td>
            </tr>
        </table>
        <h2 style="width:100%; text-align:center">ENVÍO DE GUÍAS DE TRANSPORTE </h2>

            <table cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                <tr>
                    <td style="font-size:15px;" width="50%">  <strong> No de Envío </strong> {{{ $enviomaestro[0]->id }}}</td>
                    <td style="font-size:15px; text-align:right;" width="50%"> <strong> Fecha Envío: </strong> {{{Carbon\Carbon::parse($enviomaestro[0]->created_at)->format('d-m-Y')}}} </td>
                </tr>
                <tr>
                    <td style="font-size:15px;" width="50%"> <strong> Oficina Origen </strong>  {{{ $enviomaestro[0]->oficina_envia }}} </td>
                    <td style="font-size:15px; text-align:right;" width="50%"> <strong> Oficina Destino:</strong> {{{ $enviomaestro[0]->oficina_recibe }}}</td>
                </tr>
                <tr>
                    <td style="font-size:15px;" width="50%"> <strong> Vehículo </strong> {{{ $enviomaestro[0]->vehiculo }}} </td>
                    <td style="font-size:15px; text-align:right;" width="50%"> <strong>Piloto</strong> {{{ $enviomaestro[0]->piloto }}} </td>
                </tr>
                <tr>
                    <td style="font-size:15px;" width="50%"> <strong> Total Cobrado </strong> Q. {{{number_format((float) $enviomaestro[0]->total_cobrado, 2) }}} </td>
                    <td style="font-size:15px; text-align:right;" width="50%"> <strong>Total por Cobrar</strong> Q. {{{number_format((float) $enviomaestro[0]->total_por_cobrar, 2) }}} </td>
                </tr>
            </table>
            <hr>
            <h4><u>Listado de Guías</u></h4>
            <table border="0" cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width=10%>No Guía</th>
                        <th width=20%>Envía</th>
                        <th width=20%>Recibe</th>
                        <th width=15%>Tipo Cobro</th>
                        <th width=15%>Total Guía</th>
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
            <table cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
                <tr>
                    <td style="font-size:15px;" width="50%"></td>
                    <td style="font-size:15px; text-align:right;" width="50%"> <strong>TOTAL: </strong> Q. {{{number_format((float) $enviomaestro[0]->total_enviado, 2) }}} </td>
                </tr>
            </table>
            <br>
            <h4><u>Detalle de Bultos</u></h4>
                <table border="0" cellspacing=0 cellpadding=2 width= 800 class="table table-striped table-bordered">
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
                <h4>TOTAL: {{{ $total[0]->total }}} Bultos</h4>
        </div>
    </div>
</div>

</body>
</html>