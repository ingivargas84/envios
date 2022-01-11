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
use App\Destino;
use App\Events\ActualizacionBitacora;
use Validator;

class DestinosController extends Controller
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
        return view ("admin.destinos.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.destinos.create");
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
        $destino = Destino::create($data);
        $destino->estado_id = 1;
        $destino->user_id = Auth::user()->id;
        $destino->save();
       
        event(new ActualizacionBitacora($destino->id, Auth::user()->id,'Creación','', $destino,'destinos'));
        return redirect()->route('destinos.index')->withFlash('El destino ha sido creado exitosamente!');
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
    public function edit(Destino $destino)
    {
        return view('admin.destinos.edit', compact('destino'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Destino $destino)
    {
        $this->validate($request, [
            'destino' => 'required'
        ]);

        $nuevos_datos = array(
            'destino' => $request->destino
        );

        $json = json_encode($nuevos_datos);

        event(new ActualizacionBitacora($destino->id, Auth::user()->id, 'Edición', $destino, $json, 'destinos'));

        $destino->update($request->all());
        
        return redirect()->route('destinos.index')->withFlash('El destino ha sido actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Destino $destino, Request $request)
    {
        $destino->estado_id = 2;
        $destino->save();

        event(new ActualizacionBitacora($destino->id, Auth::user()->id, 'Inactivación', '', '', 'destinos'));

        return Response::json(['success' => 'Éxito']);
    }

    public function activar(Destino $destino, Request $request)
    {
        $destino->estado_id = 1;
        $destino->save();

        event(new ActualizacionBitacora($destino->id, Auth::user()->id, 'Activación', '', '', 'destinos'));

        return Response::json(['success' => 'Éxito']);
    }

    public function getJson(Request $params)
     {

         $api_result['data'] = Destino::select(
            'destinos.id',
            'destinos.destino',
            'users.name',
            'estados.estado',
            'destinos.created_at'
        )->join(
            'users',
            'destinos.user_id',
            '=',
            'users.id'
        )->join(
            'estados',
            'destinos.estado_id',
            '=',
            'estados.id'
        )->get();



         return Response::json( $api_result );
     }
}
