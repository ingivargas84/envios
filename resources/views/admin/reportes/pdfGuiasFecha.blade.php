<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Document</title>
    <style>
        .head {
            padding: 10px;
        }

        table {
            border-radius: 10px;
            padding: 10px;
            width: 100%;
            margin-bottom: 7px;
        }

        #datos, #datos td  {
            margin-left: 3%;
            border: 1px solid black;
            border-collapse: collapse;
            font-size: 16px;
            text-align: center;
        }
    </style>
</head>

<body>
    <table>
        <tr class="head">
            <td style="width:60%;">
                <p> <h1>TRANSPORTES ORELLANA</h1>
                    <b>* Oficina 21 calle, etre 11 y 12 Av, Zona 1, Guatemala - Tels: 2232-8434 | 5137-5112 | 5016-4454 </b><br>
                    <b>* Oficina Centra Norte, Local 24, Guatemala - Tel: 5137-5112 </b><br>
                    <b>* Hotel y Turicentro Paola, Guastatoya, El Progreso - Tels: 7945-2070 | 5692-9463 </b><br>
                 </p>
            </td>
            <td  style="width:25%; text-align: right;">
              <img src="images/logo1.jpg">
            </td>
        </tr>
    </table>
    <br>
    <table>
        <tr>
            <td style="font-Size: 24px; text-align: center;"><b><u> Reporte de Guías por Fecha</u></b></td>
        </tr>
        <tr>
          <td style="font-Size: 18px; text-align: center;"><b> {{{$fecha}}}</b></td>
        </tr>
    </table>


        <table id="datos">
        <tr>
            <td style="align=left">
              No guía.
            </td>
            <td style="align=left">
              Persona Envia - Teléfono
            </td>
            <td style="align=right">
              Persona Recibe - Teléfono
            </td>
            <td style="align=right">
              Destino
            </td>
            <td style="align=right">
              Oficinas
            </td>
            <td style="align=right">
              Tipo Cobro
            </td>
            <td style="align=right">
              Subtotal (Q.)
            </td>

        </tr>
        
        @foreach($data as $d)
        <tr>
            <td style="text-align: center; font-size:10px;">{{$d->cod_oficina}}-{{$d->no_guia}}-2021</td>
            <td style="text-align: left; font-size:10px;">{{$d->envia}}-{{$d->tenvia}}</td>
            <td style="text-align: left; font-size:10px;">{{$d->recibe}}-{{$d->trecibe}}</td>
            <td style="text-align: left; font-size:10px;">{{$d->destino}}</td>
            <td style="text-align: center; font-size:10px;">{{$d->origen}} -> {{$d->of_destino}}</td>
            <td style="text-align: center; font-size:10px;">{{$d->tipo_cobro}}</td>
            <td style="text-align: right; font-size:10px;">Q.<?php echo number_format($d->total_flete, 2, ".", ",");?></td>
        </tr>
        @endforeach
    </table>
    
<footer>
    <b> Reporte generado por  @foreach($usuario as $u)
        "{{$u->username}}"
      @endforeach  el 
      
      <?php echo date("d/m/Y");?> a las <?php echo date("H:i:s");?> horas. </b>
</footer>
</body>

</html>