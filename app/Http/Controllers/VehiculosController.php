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
use App\Vehiculo;
use App\Events\ActualizacionBitacora;
use Validator;

class VehiculosController extends Controller
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
        return view ("admin.vehiculos.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.vehiculos.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $vehiculo = Vehiculo::create($data);
        $vehiculo->estado_id = 1;
        $vehiculo->user_id = Auth::user()->id;
        $vehiculo->save();
       
        event(new ActualizacionBitacora($vehiculo->id, Auth::user()->id,'Creación','', $vehiculo,'destinos'));
        return redirect()->route('vehiculos.index')->withFlash('El vehiculo ha sido creado exitosamente!');
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
    public function edit(Vehiculo $vehiculo)
    {
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $this->validate($request, [
            'no_placa' => 'required',
            'descripcion' => 'required'
        ]);

        $nuevos_datos = array(
            'no_placa' => $request->no_placa,
            'descripcion' => $request->descripcion
        );

        $json = json_encode($nuevos_datos);

        event(new ActualizacionBitacora($vehiculo->id, Auth::user()->id, 'Edición', $vehiculo, $json, 'vehiculos'));

        $vehiculo->update($request->all());
        
        return redirect()->route('vehiculos.index')->withFlash('El vehiculo ha sido actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo, Request $request)
    {
        $vehiculo->estado_id = 2;
        $vehiculo->save();

        event(new ActualizacionBitacora($vehiculo->id, Auth::user()->id, 'Inactivación', '', '', 'vehiculos'));

        return Response::json(['success' => 'Éxito']);
    }

    public function activar(Vehiculo $vehiculo, Request $request)
    {
        $vehiculo->estado_id = 1;
        $vehiculo->save();

        event(new ActualizacionBitacora($vehiculo->id, Auth::user()->id, 'Activación', '', '', 'vehiculos'));

        return Response::json(['success' => 'Éxito']);
    }

    public function getJson(Request $params)
     {

         $api_result['data'] = Vehiculo::select(
            'vehiculos.id',
            'vehiculos.no_placa',
            'vehiculos.descripcion',
            'users.name',
            'estados.estado',
            'vehiculos.created_at'
        )->join(
            'users',
            'vehiculos.user_id',
            '=',
            'users.id'
        )->join(
            'estados',
            'vehiculos.estado_id',
            '=',
            'estados.id'
        )->get();

         return Response::json( $api_result );
     }
}


