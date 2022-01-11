<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use App\User;
use App\Empleado;
use App\Vehiculo;
use App\Oficina;
use App\Guia;
use App\Envio_Maestro;
use App\Envio_Detalle;
use App\Guia_Detalle;
use App\Movimiento_Guia;
use App\Events\ActualizacionBitacora;
use Barryvdh\DomPDF\Facade as PDF;
use PHPUnit\Framework\Constraint\Count;
use Validator;

class EnviosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
       $this->middleware('auth');
    }
    
    
     public function index()
    {
        return view ("admin.envios.index");
    }


    public function getJson(Request $params)
    {

        $api_result['data'] = Envio_Maestro::select(
            'envios_maestro.id',
            'ofe.nombre as oficina_envia',
            'ofr.nombre as oficina_recibe',
            'vehiculos.descripcion as vehiculo',
            'empleados.nombre_empleado as piloto',
            'envios_maestro.total_cobrado',
            'envios_maestro.total_por_cobrar',
            'users.name',
            'envios_maestro.estado_guia_id',
            'estado_guia.estado_guia'
        )->join(
            'oficinas as ofe',
            'envios_maestro.oficina_envia_id',
            '=',
            'ofe.id'
        )->join(
            'oficinas as ofr',
            'envios_maestro.oficina_recibe_id',
            '=',
            'ofr.id'
        )->join(
            'vehiculos',
            'envios_maestro.vehiculo_id',
            '=',
            'vehiculos.id'
        )->join(
            'empleados',
            'envios_maestro.piloto_id',
            '=',
            'empleados.id'
        )->join(
           'users',
           'envios_maestro.user_id',
           '=',
           'users.id'
        )->join(
           'estado_guia',
           'envios_maestro.estado_guia_id',
           '=',
           'estado_guia.id'
        )->get();

        return Response::json( $api_result );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oficina = Oficina::WHERE("estado_id","=", 1)->get();
        $vehiculos = Vehiculo::WHERE("estado_id","=", 1)->get();
        $pilotos = Empleado::WHERE("estado_id","=", 1)->get();
        $guias = Guia::WHERE("estado_guia_id","=", 1)->get();
        $user_crea = Auth::user()->name;
        
        return view('admin.envios.create', compact('oficina', 'vehiculos', 'pilotos', 'user_crea', 'guias'));
    }


    public function getGuia($id){
        $api_result = Guia::Where("id","=",$id)->Where("estado_guia_id","=",1)->get();  
        return Response::json($api_result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $arr = json_decode($request->getContent(), true); 

        $cobrado = 0;
        $porcobrar = 0;

        $oficina_envia_id           = $arr[1]["value"];
        $oficina_recibe_id          = $arr[2]["value"];
        $vehiculo_id                = $arr[3]["value"];
        $piloto_id                  = $arr[4]["value"];
        $user_id                    = Auth::user()->id;
        $estado_guia_id             = 1;

        $envm = Envio_Maestro::create([
            'oficina_envia_id'          => $oficina_envia_id,
            'oficina_recibe_id'         => $oficina_recibe_id,
            'vehiculo_id'               => $vehiculo_id,
            'piloto_id'                 => $piloto_id,
            'user_id'                   => $user_id,
            'estado_guia_id'            => $estado_guia_id
            ]);

        for ($i=6; $i < sizeof($arr) ; $i++) {
            $envd = Envio_Detalle::create([
                'envio_maestro_id'      => $envm->id,
                'guia_id'               => $arr[$i]["id"]
            ]);

            $guias_detalle = Guia_Detalle::where("guia_id","=",$arr[$i]["id"])->get();

            for($j=0; $j<count($guias_detalle); $j++)
            {
                $guias_detalle[$j]->envio_maestro_id = $envm->id;
                $guias_detalle[$j]->save();
            }

            if($arr[$i]["tipo_cobro"] == 1)
            {
                $cobrado = $cobrado + $arr[$i]["total_flete"];
            }
            else
            {
                $porcobrar = $porcobrar + $arr[$i]["total_flete"];
            }
        }

        $envm->total_cobrado = $cobrado;
        $envm->total_por_cobrar = $porcobrar;
        $envm->total_enviado = $cobrado + $porcobrar;
        $envm->save();

        //writes the new purchase to log
        event(new ActualizacionBitacora($envm->id, Auth::user()->id, 'Creación', '', $envm, 'envio maestro'));

        return Response::json(['success' => 'Éxito']);
    }

    
    
    public function show(Envio_Maestro $envio_maestro)
    {
        $enviomaestro = Envio_Maestro::select(
            'envios_maestro.id',
            'ofe.nombre as oficina_envia',
            'ofr.nombre as oficina_recibe',
            'vehiculos.descripcion as vehiculo',
            'empleados.nombre_empleado as piloto',
            'envios_maestro.total_cobrado',
            'envios_maestro.total_por_cobrar',
            'envios_maestro.total_enviado',
            'users.name',
            'envios_maestro.estado_guia_id',
            'envios_maestro.created_at',
            'estado_guia.estado_guia'
        )->join(
            'oficinas as ofe',
            'envios_maestro.oficina_envia_id',
            '=',
            'ofe.id'
        )->join(
            'oficinas as ofr',
            'envios_maestro.oficina_recibe_id',
            '=',
            'ofr.id'
        )->join(
            'vehiculos',
            'envios_maestro.vehiculo_id',
            '=',
            'vehiculos.id'
        )->join(
            'empleados',
            'envios_maestro.piloto_id',
            '=',
            'empleados.id'
        )->join(
           'users',
           'envios_maestro.user_id',
           '=',
           'users.id'
        )->join(
           'estado_guia',
           'envios_maestro.estado_guia_id',
           '=',
           'estado_guia.id'
        )->where(
           'envios_maestro.id',
            '=',
            $envio_maestro->id
        )->get();


        $enviodetalle = Envio_Detalle::select(
            'envios_detalle.id',
            'envios_detalle.envio_maestro_id',
            'envios_detalle.guia_id',
            'tipo_cobro.tipo_cobro',
            'tipo_paquete.tipo_paquete',
            'guias.no_guia',
            'guias.nombre_origen',
            'guias.nombre_destino',
            'guias.cantidad_contenido',
            'guias.total_flete'
        )->join(
            'guias',
            'envios_detalle.guia_id',
            '=',
            'guias.id'
        )->join(
            'tipo_cobro',
            'guias.tipo_cobro_id',
            '=',
            'tipo_cobro.id'
        )->join(
            'tipo_paquete',
            'guias.tipo_paquete_id',
            '=',
            'tipo_paquete.id'
        )->where(
            'envios_detalle.envio_maestro_id',
            '=',
            $envio_maestro->id
        )->get();


        $paquetes = Guia_Detalle::select(
            'tipo_paquete.tipo_paquete',
            DB::raw('SUM(guias_detalle.cantidad) as total')
        )->join(
            'tipo_paquete',
            'guias_detalle.tipo_paquete_id',
            '=',
            'tipo_paquete.id'
        )->groupBy(
            'tipo_paquete.tipo_paquete'
        )->where(
            'guias_detalle.envio_maestro_id',
            '=',
            $envio_maestro->id
        )->get();

        return view('admin.envios.show', compact('enviomaestro', 'enviodetalle', 'paquetes'));
    }


    public function pdfEnvio(Envio_Maestro $envio_maestro)
    {
        $enviomaestro = Envio_Maestro::select(
            'envios_maestro.id',
            'ofe.nombre as oficina_envia',
            'ofr.nombre as oficina_recibe',
            'vehiculos.descripcion as vehiculo',
            'empleados.nombre_empleado as piloto',
            'envios_maestro.total_cobrado',
            'envios_maestro.total_por_cobrar',
            'envios_maestro.total_enviado',
            'users.name',
            'envios_maestro.estado_guia_id',
            'envios_maestro.created_at',
            'estado_guia.estado_guia'
        )->join(
            'oficinas as ofe',
            'envios_maestro.oficina_envia_id',
            '=',
            'ofe.id'
        )->join(
            'oficinas as ofr',
            'envios_maestro.oficina_recibe_id',
            '=',
            'ofr.id'
        )->join(
            'vehiculos',
            'envios_maestro.vehiculo_id',
            '=',
            'vehiculos.id'
        )->join(
            'empleados',
            'envios_maestro.piloto_id',
            '=',
            'empleados.id'
        )->join(
           'users',
           'envios_maestro.user_id',
           '=',
           'users.id'
        )->join(
           'estado_guia',
           'envios_maestro.estado_guia_id',
           '=',
           'estado_guia.id'
        )->where(
           'envios_maestro.id',
            '=',
            $envio_maestro->id
        )->get();


        $enviodetalle = Envio_Detalle::select(
            'envios_detalle.id',
            'envios_detalle.envio_maestro_id',
            'envios_detalle.guia_id',
            'tipo_cobro.tipo_cobro',
            'tipo_paquete.tipo_paquete',
            'guias.no_guia',
            'guias.nombre_origen',
            'guias.nombre_destino',
            'guias.cantidad_contenido',
            'guias.total_flete'
        )->join(
            'guias',
            'envios_detalle.guia_id',
            '=',
            'guias.id'
        )->join(
            'tipo_cobro',
            'guias.tipo_cobro_id',
            '=',
            'tipo_cobro.id'
        )->join(
            'tipo_paquete',
            'guias.tipo_paquete_id',
            '=',
            'tipo_paquete.id'
        )->where(
            'envios_detalle.envio_maestro_id',
            '=',
            $envio_maestro->id
        )->get();


        $paquetes = Guia_Detalle::select(
            'tipo_paquete.tipo_paquete',
            DB::raw('SUM(guias_detalle.cantidad) as total')
        )->join(
            'tipo_paquete',
            'guias_detalle.tipo_paquete_id',
            '=',
            'tipo_paquete.id'
        )->groupBy(
            'tipo_paquete.tipo_paquete'
        )->where(
            'guias_detalle.envio_maestro_id',
            '=',
            $envio_maestro->id
        )->get();

        $total = Guia_Detalle::select(
            DB::raw('SUM(guias_detalle.cantidad) as total')
        )->where(
            'guias_detalle.envio_maestro_id',
            '=',
            $envio_maestro->id
        )->get();

        $pdf = \PDF::loadView('admin.envios.pdfenvio', compact('enviomaestro', 'enviodetalle', 'paquetes', 'total'));
        return $pdf->stream('envio_de_guias.pdf');
    }


    public function ruta(Envio_Maestro $envio_maestro)
    {
        $envio_maestro->estado_guia_id = 2;
        $envio_maestro->save();

        $guias = Envio_Detalle::where("envio_maestro_id","=",$envio_maestro->id)->get();

        for($i=0; $i < count($guias); $i++)
        {
            $guia = Guia::where("id","=",$guias[$i]->guia_id)->get();
            $guia[0]->estado_guia_id = 2;
            $guia[0]->save();

            $mg = Movimiento_Guia::create([
                'user_id'           => Auth::user()->id,
                'guia_id'           => $guias[$i]->guia_id,
                'estado_guia_id'    => 2,
            ]);
        }

        return view ("admin.envios.index");
    }



    public function oficina(Envio_Maestro $envio_maestro)
    {
        $envio_maestro->estado_guia_id = 3;
        $envio_maestro->save();

        $guias = Envio_Detalle::where("envio_maestro_id","=",$envio_maestro->id)->get();

        for($i=0; $i < count($guias); $i++)
        {
            $guia = Guia::where("id","=",$guias[$i]->guia_id)->get();
            $guia[0]->estado_guia_id = 3;
            $guia[0]->save();

            $mg = Movimiento_Guia::create([
                'user_id'           => Auth::user()->id,
                'guia_id'           => $guias[$i]->guia_id,
                'estado_guia_id'    => 3,
            ]);
        }


        return view ("admin.envios.index");
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
