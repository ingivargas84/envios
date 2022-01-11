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
use App\Guia;
use App\Guia_Detalle;
use App\Entrega_Guia;
use App\Movimiento_Guia;
use App\Oficina;
use App\Tipo_Paquete;
use App\Tipo_Entrega;
use App\Tipo_Cobro;
use App\Estado_Guia;
use App\Destino;
use App\Empresa;
use App\Empleado;
use App\Vehiculo;
use App\Events\ActualizacionBitacora;
use Validator;

class GuiasController extends Controller
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
        return view ("admin.guias.index");
    }

    public function rpt_guias()
    {
        $oficinas = Oficina::select()->where('estado_id', '=', 1)->get();
        $vehiculos = Vehiculo::select()->where('estado_id', '=', 1)->get();
        $pilotos = Empleado::select()->where('estado_id', '=', 1)->get();

        return view('admin.guias.rpt_guias', compact('oficinas', 'vehiculos', 'pilotos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $query_guia = "SELECT MAX(no_guia) as no_guia FROM guias WHERE tipo_guia = 1";
        $noguia = DB::select($query_guia);

        $oficinas = Oficina::select()->where('estado_id', '=', '1')->get();
        $tipo_cobro = Tipo_Cobro::all();
        $tipo_paquete = Tipo_Paquete::all();
        $empresa = Empresa::select()->where('estado_id', '=', '1')->get();
        $destinos = Destino::select()->where('estado_id', '=', '1')->get();

        $guia = $noguia[0]->no_guia;

        if ($guia > 0)
        {
            $guia = intval($guia) + 1;
        }
        else
        {
            $guia = 1;
        }      

        return view('admin.guias.create', compact('oficinas', 'guia', 'tipo_cobro', 'tipo_paquete', 'destinos', 'empresa'));
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

        $no_guia                = $arr[2]["value"];
        $tipo_guia              = $arr[1]["value"];
        $nombre_origen          = $arr[5]["value"];
        $telefono_origen        = $arr[6]["value"];
        $oficina_origen_id      = $arr[3]["value"];
        $oficina_destino_id     = $arr[4]["value"];
        $nombre_destino         = $arr[8]["value"];
        $telefono_destino       = $arr[9]["value"];
        $destino_id             = $arr[10]["value"];
        $descripcion_contenido  = $arr[11]["value"];
        $cantidad_contenido     = 0;
        $tipo_paquete_id        = 1;
        $tipo_cobro_id          = $arr[12]["value"];
        $total_flete            = $arr[13]["value"];
        $fragil                 = $arr[7]["value"];
        $empresa_id             = $arr[15]["value"];
        $no_envio               = $arr[14]["value"];
        $user_id                = Auth::user()->id;
        $estado_guia_id         = 1;


        $guia = Guia::create([
            'no_guia'               => $no_guia,
            'tipo_guia'             => $tipo_guia,
            'nombre_origen'         => $nombre_origen,
            'telefono_origen'       => $telefono_origen,
            'oficina_origen_id'     => $oficina_origen_id,
            'oficina_destino_id'    => $oficina_destino_id,
            'nombre_destino'        => $nombre_destino,
            'telefono_destino'      => $telefono_destino,
            'destino_id'            => $destino_id,
            'descripcion_contenido' => $descripcion_contenido,
            'cantidad_contenido'    => $cantidad_contenido,
            'tipo_paquete_id'       => $tipo_paquete_id,
            'tipo_cobro_id'         => $tipo_cobro_id,
            'total_flete'           => $total_flete,
            'fragil'                => $fragil,
            'empresa_id'            => $empresa_id,
            'no_envio'              => $no_envio,
            'user_id'               => $user_id,
            'estado_guia_id'        => $estado_guia_id,
            ]);

            $mg = Movimiento_Guia::create([
                'user_id'           => Auth::user()->id,
                'guia_id'           => $guia->no_guia,
                'estado_guia_id'    => 1,

            ]);

        for ($i=20; $i < sizeof($arr) ; $i++) {
            $gd = Guia_Detalle::create([
                'guia_id'           => $guia->id,
                'cantidad'          => $arr[$i]["cantidad_contenido"],
                'tipo_paquete_id'   => $arr[$i]["tipo_paquete_id"],
                'descripcion'       => $arr[$i]["descripcion_detalle"],
            ]);

            
        }
       
        event(new ActualizacionBitacora($guia->id, Auth::user()->id,'Creación','', $guia,'guias'));

        return Response::json(['success' => 'Éxito']);
               
    }


    public function entrega(Guia $guia)
    {
        $tipo_entrega = Tipo_Entrega::all();

        $guias = Guia::select()->where('id', '=', $guia->id )->get();
        $oficina_origen = Oficina::select()->where('id', '=', $guia->oficina_origen_id)->get();
        $tipo_cobro = Tipo_Cobro::select()->where('id','=',$guia->tipo_cobro_id)->get();
        
        
        return view('admin.guias.entrega', compact('guias', 'tipo_entrega', 'oficina_origen', 'tipo_cobro'));
    }


    public function saveentrega(Request $request)
    {
        $data = $request->all();

        $guia = Entrega_Guia::create($data);
        $guia->user_id = Auth::user()->id;
        $guia->save();

        $gg = Guia::where("id","=",$guia->guia_id)->get();
        $gg[0]->estado_guia_id = 5;
        $gg[0]->save();

        $mg = Movimiento_Guia::create([
            'user_id'           => Auth::user()->id,
            'guia_id'           => $guia->guia_id,
            'estado_guia_id'    => 5,

        ]);
       
        event(new ActualizacionBitacora($guia->id, Auth::user()->id,'Entrega','', $guia,'guias'));

        return redirect()->route('guias.index')->withFlash('La entrega se ha registrado exitosamente!');
    }


    public function gestion_guias()
    {
        $oficinas = Oficina::select()->where('estado_id', '=', '1')->get();
        $vehiculos = Vehiculo::select()->where('estado_id', '=', '1')->get();
        $empleados = Empleado::select()->where('estado_id', '=', '1')->get();
        $estado_guia = Estado_Guia::all();
        $guias = Guia::select()->where('estado_guia_id', '=', '1')->get();

        return view('admin.guias.gestion', compact('oficinas', 'vehiculos', 'estado_guia', 'empleados', 'guias'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guia $guia)
    {
        $guia_nueva = Guia::select()->where('id', '=', $guia->id )->get();
        $usuario = User::select()->where('id','=', $guia->user_id)->get();
        $oficina_origen = Oficina::select()->where('id', '=', $guia->oficina_origen_id)->get();
        $oficina_destino = Oficina::select()->where('id', '=', $guia->oficina_destino_id)->get();
        $destino = Destino::select()->where('id','=',$guia->destino_id)->get();
        $paquete = Tipo_Paquete::select()->where('id','=',$guia->tipo_paquete_id)->get();
        $tipo_cobro = Tipo_Cobro::select()->where('id','=',$guia->tipo_cobro_id)->get();
        $empresa = Empresa::select()->where('id','=',$guia->empresa_id)->get();

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

        $entrega_guia = Entrega_Guia::select(
            'entrega_guia.id',
            'tipo_entrega.tipo_entrega',
            'entrega_guia.dpi',
            'entrega_guia.nombre_recibe',
            'users.name'
        )->join(
            'users',
            'entrega_guia.user_id',
            '=',
            'users.id'
        )->join(
            'tipo_entrega',
            'entrega_guia.tipo_entrega_id',
            '=',
            'tipo_entrega.id'
        )->where(
            'entrega_guia.guia_id', 
            '=', 
            $guia->id 
        )->get();

        $movimientos_guia = Movimiento_Guia::select(
            'movimiento_guias.id',
            'movimiento_guias.estado_guia_id',
            'estado_guia.estado_guia',
            'movimiento_guias.created_at',
            'users.name'
        )->join(
            'users',
            'movimiento_guias.user_id',
            '=',
            'users.id'
        )->join(
            'estado_guia',
            'movimiento_guias.estado_guia_id',
            '=',
            'estado_guia.id'
        )->where(
            'movimiento_guias.guia_id', 
            '=', 
            $guia->id 
        )->get();
        
        return view('admin.guias.show', compact('guia_nueva', 'guia_detalle', 'suma', 'entrega_guia', 'movimientos_guia', 'usuario', 'destino', 'oficina_origen', 'oficina_destino', 'paquete', 'tipo_cobro', 'empresa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guia $guia)
    {
        $oficinas = Oficina::select()->where('estado_id', '=', '1')->get();
        $tipo_cobro = Tipo_Cobro::all();
        $tipo_paquete = Tipo_Paquete::all();
        $empresa = Empresa::select()->where('estado_id', '=', '1')->get();
        $destinos = Destino::select()->where('estado_id', '=', '1')->get();

        return view('admin.guias.edit', compact('guia', 'oficinas', 'tipo_cobro', 'empresa', 'destinos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Guia $guia)
    {
        $nuevos_datos = array(
            'oficina_recibe_id' => $request->oficina_recibe_id,
            'oficina_destino_id' => $request->oficina_destino_id,
            'nombre_origen' => $request->nombre_origen,
            'telefono_origen' => $request->telefono_origen,
            'fragil' => $request->fragil,
            'nombre_destino' => $request->nombre_destino,
            'telefono_origen' => $request->telefono_origen,
            'destino_id' => $request->destino_id,
            'descripcion_contenido' => $request->descripcion_contenido,
            'tipo_cobro_id' => $request->tipo_cobro_id,
            'total_flete' => $request->total_flete,
            'no_envio' => $request->no_envio,
            'empresa_id' => $request->empresa_id,
        );

        $json = json_encode($nuevos_datos);

        event(new ActualizacionBitacora($guia->id, Auth::user()->id, 'Edición', $guia, $json, 'oficinas'));

        $guia->update($request->all());
        
        return redirect()->route('guias.index')->withFlash('La guia ha sido actualizado exitosamente!');
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

    public function getPaquete($id){
        $api_result = Tipo_Paquete::Where("id","=",$id)->get();
          
        return Response::json($api_result);
    }


    
    public function getJson(Request $params)
     {

         $api_result['data'] = Guia::select(
            'guias.id',
            'guias.no_guia',
            'guias.nombre_origen',
            'guias.nombre_destino',
            'guias.total_flete',
            'guias.estado_guia_id',
            'tipo_cobro.tipo_cobro',
            'tipo_paquete.tipo_paquete',
            'users.name',
            'estado_guia.estado_guia',
            'guias.created_at'
        )->join(
            'users',
            'guias.user_id',
            '=',
            'users.id'
        )->join(
            'estado_guia',
            'guias.estado_guia_id',
            '=',
            'estado_guia.id'
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
        )->get();

         return Response::json( $api_result );
     }
}
