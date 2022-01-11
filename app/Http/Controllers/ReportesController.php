<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Guia;
use App\Guia_Detalle;
use App\Oficina;
use App\Destino;
use App\Envio_Maestro;
use App\Tipo_Paquete;
use App\Tipo_Cobro;
use App\Empresa;


class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    function guias_fecha(Request $request)
    {
        $datos = $request->all();
        
        $envio_maestro = Envio_Maestro::create($datos);
        $envio_maestro->oficina_envia_id = 1;
        $envio_maestro->estado_guia_id = 1;
        $envio_maestro->user_id = Auth::user()->id;
        $envio_maestro->save();

        $fecha = Carbon::parse($request->fecha_guias)->format('d-m-Y');
        $fecha2 = Carbon::parse($request->fecha_guias)->format('Y-m-d');

        $query ="SELECT g.no_guia AS no_guia, tc.tipo_cobro, of.cod_oficina, of.nombre AS origen, of2.nombre AS of_destino, g.nombre_origen AS envia, g.telefono_origen AS tenvia, g.nombre_destino AS recibe, g.telefono_destino as trecibe, des.destino as destino, g.cantidad_contenido, tp.tipo_paquete, g.total_flete
        FROM guias g
        INNER JOIN tipo_paquete tp ON g.tipo_paquete_id=tp.id
        INNER JOIN destinos des ON g.destino_id= des.id
        INNER JOIN oficinas of ON g.oficina_origen_id = of.id
        INNER JOIN oficinas of2 ON g.oficina_destino_id = of2.id
        INNER JOIN tipo_cobro tc ON g.tipo_cobro_id = tc.id
        WHERE DATE(g.created_at) = '" . $fecha2 . "' 
        ORDER BY g.id ASC";
        $data = DB::select($query);

        $usuario = User::where("id", Auth::user()->id)->get() ;
        
        $pdf = \PDF::loadView('admin.reportes.pdfGuiasFecha', compact('data', 'usuario', 'fecha'))->setPaper('a4', 'landscape');
        return $pdf->stream('ReporteGuiasporFecha.pdf');

    }

    function guias(Guia $guia)
    {
        $fecha = date('d-m-Y');
        $guia_nueva = Guia::select()->where('id', '=', $guia->id )->get();
        $usuario = User::select()->where('id','=', $guia->user_id)->get();
        $oficina_origen = Oficina::select()->where('id', '=', $guia->oficina_origen_id)->get();
        $oficina_destino = Oficina::select()->where('id', '=', $guia->oficina_destino_id)->get();
        $destino = Destino::select()->where('id','=',$guia->destino_id)->get();
        $paquete = Tipo_Paquete::select()->where('id','=',$guia->tipo_paquete_id)->get();
        $tipo_cobro = Tipo_Cobro::select()->where('id','=',$guia->tipo_cobro_id)->get();
        $empresa = Empresa::select()->where('id','=',$guia->empresa_id)->get();   
        $user = User::where("id", Auth::user()->id)->get() ;   

        $guia_detalle = Guia_Detalle::select(
            'guias_detalle.id',
            'guias_detalle.cantidad',
            'guias_detalle.descripcion',
            'tipo_paquete.tipo_paquete'
        )->join(
            'tipo_paquete',
            'guias_detalle.tipo_paquete_id',
            '=',
            'tipo_paquete.id'
        )->where(
            'guias_detalle.guia_id', 
            '=', 
            $guia->id 
        )->get();

        $suma = Guia_Detalle::select(
            DB::raw('SUM(guias_detalle.cantidad) as total')
        )->where(
            'guias_detalle.guia_id', 
            '=', 
            $guia->id 
        )->get();

        $pdf = \PDF::loadView('admin.reportes.pdfGuias', compact('fecha', 'guia_nueva', 'guia_detalle', 'suma', 'usuario', 'user', 'oficina_origen', 'oficina_destino', 'destino', 'paquete', 'tipo_cobro', 'empresa' ))->setPaper('a4', 'portrait');
        return $pdf->stream('ReporteGuias.pdf');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
