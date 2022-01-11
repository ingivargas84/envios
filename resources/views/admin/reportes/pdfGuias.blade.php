<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Guia_Transporte</title>
    
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
        }
        table, th, td {
            border: 1px solid white;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
    
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
        <hr>
        <h2 style="width:100%; text-align:center">GUÍA DE TRANSPORTE <strong><u>{{$oficina_origen[0]->cod_oficina}}-{{$guia_nueva[0]->no_guia}}-2021</u></strong></h2>

        <table class="table table-striped table-bordered" border="1" cellspadding=2>
            <tr>
                <td style="width:65%; text-align:left; font-size:15px"> <strong>Recibimos de:</strong> <u>{{$guia_nueva[0]->nombre_origen}}</u> <strong>Teléfono:</strong> <u>{{$guia_nueva[0]->telefono_origen}}</u> </td>
                <td style="width:35%; text-align:right; font-size:15px"> <strong>Oficina Envia:</strong> <u>{{$oficina_origen[0]->nombre}}</u> </td>
            </tr>
            <tr>
                <td style="width:65%; text-align:left; font-size:15px"> <strong>Dirigida a:</strong> <u>{{$guia_nueva[0]->nombre_destino}}</u> <strong>Teléfono:</strong> <u>{{$guia_nueva[0]->telefono_destino}}</u> </td>
                <td style="width:35%; text-align:right; font-size:15px"> <strong>Oficina Recibe:</strong> <u>{{$oficina_destino[0]->nombre}}</u> </td>
            </tr>
            <tr>
                <td style="width:50%; text-align:left; font-size:15px"> <strong>Conteniendo:</strong> <u>{{$guia_nueva[0]->descripcion_contenido}}; <strong>{{$suma[0]->total}} Bultos</strong></u> </td>
                <td style="width:50%; text-align:right; font-size:15px"> <strong>Destino:</strong> <u>{{$destino[0]->destino}}</u> </td>
            </tr>
            <tr>
                <td style="width:65%; text-align:left; font-size:15px"> <strong>Flete:</strong> <u>Q. {{ number_format((float) $guia_nueva[0]->total_flete, 2) }} {{$tipo_cobro[0]->tipo_cobro}}</u> </td>
                <td style="width:35%; text-align:center; font-size:15px">
                    @if ($guia_nueva[0]->fragil == 1) 
                        <strong>FRÁGIL</strong>
                    @else
                        <strong>NO FRÁGIL</strong>
                    @endif
                </td>
            </tr>
        </table>
        <table border="1" cellspacing=0 cellpadding=2 width=800 class="table table-striped table-bordered">
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
        <table class="table table-striped table-bordered" border="1" cellspadding=2>
            <tr>
                <td style="width:65%; text-align:center; font-size:24px"><strong>NO SE ACEPTAN RECLAMOS DESPUES DE 30 DIAS</strong></td>
                <td style="width:35%; text-align:center;">
                    <h5> Atendió: {{$user[0]->name}}, 
                    <?php echo date("d/m/Y");?> a las <?php echo date("H:i:s");?> horas. </h5>
                </td>
            </tr>
         </table>
        </div>

        <hr style="border-top: dotted 2px;">

        <div class="row">
    
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
    <hr>
    <h2 style="width:100%; text-align:center">GUÍA DE TRANSPORTE <strong><u>{{$oficina_origen[0]->cod_oficina}}-{{$guia_nueva[0]->no_guia}}-2021</u></strong></h2>

    <table class="table table-striped table-bordered" border="1" cellspadding=2>
        <tr>
            <td style="width:65%; text-align:left; font-size:15px"> <strong>Recibimos de:</strong> <u>{{$guia_nueva[0]->nombre_origen}}</u> <strong>Teléfono:</strong> <u>{{$guia_nueva[0]->telefono_origen}}</u> </td>
            <td style="width:35%; text-align:right; font-size:15px"> <strong>Oficina Envia:</strong> <u>{{$oficina_origen[0]->nombre}}</u> </td>
        </tr>
        <tr>
            <td style="width:65%; text-align:left; font-size:15px"> <strong>Dirigida a:</strong> <u>{{$guia_nueva[0]->nombre_destino}}</u> <strong>Teléfono:</strong> <u>{{$guia_nueva[0]->telefono_destino}}</u> </td>
            <td style="width:35%; text-align:right; font-size:15px"> <strong>Oficina Recibe:</strong> <u>{{$oficina_destino[0]->nombre}}</u> </td>
        </tr>
        <tr>
            <td style="width:50%; text-align:left; font-size:15px"> <strong>Conteniendo:</strong> <u>{{$guia_nueva[0]->descripcion_contenido}}; <strong>{{$suma[0]->total}} Bultos</strong></u> </td>
            <td style="width:50%; text-align:right; font-size:15px"> <strong>Destino:</strong> <u>{{$destino[0]->destino}}</u> </td>
        </tr>
        <tr>
            <td style="width:65%; text-align:left; font-size:15px"> <strong>Flete:</strong> <u>Q. {{ number_format((float) $guia_nueva[0]->total_flete, 2) }} {{$tipo_cobro[0]->tipo_cobro}}</u> </td>
            <td style="width:35%; text-align:center; font-size:15px">
                @if ($guia_nueva[0]->fragil == 1) 
                    <strong>FRÁGIL</strong>
                @else
                    <strong>NO FRÁGIL</strong>
                @endif
            </td>
        </tr>
    </table>
    <table border="1" cellspacing=0 cellpadding=2 width=800 class="table table-striped table-bordered">
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
    <table class="table table-striped table-bordered" border="1" cellspadding=2>
        <tr>
            <td style="width:65%; text-align:center; font-size:24px"><strong>NO SE ACEPTAN RECLAMOS DESPUES DE 30 DIAS</strong></td>
            <td style="width:35%; text-align:center;">
                <h5> Atendió: {{$user[0]->name}}, 
                <?php echo date("d/m/Y");?> a las <?php echo date("H:i:s");?> horas. </h5>
            </td>
        </tr>
     </table>
     <br><br><br>
     <table class="table table-striped table-bordered" border="1" cellspadding=2>
        <tr>
            <td style="width:100%; text-align:center; font-size:14px"><strong>Recibí: </strong>Nombre:_____________________________________DPI:_______________________Firma:_______________</td>
        </tr>
     </table>
    </div>
    </div>
</body>

</html>