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
use App\Oficina;
use App\Events\ActualizacionBitacora;
use Validator;

class OficinasController extends Controller
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
        return view ("admin.oficinas.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.oficinas.create");
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
        $oficina = Oficina::create($data);
        $oficina->estado_id = 1;
        $oficina->user_id = Auth::user()->id;
        $oficina->save();
       
        event(new ActualizacionBitacora($oficina->id, Auth::user()->id,'Creación','', $oficina,'oficinas'));
        return redirect()->route('oficinas.index')->withFlash('La oficina ha sido creado exitosamente!');
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
    public function edit(Oficina $oficina)
    {
        return view('admin.oficinas.edit', compact('oficina'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Oficina $oficina)
    {
        $this->validate($request, [
            'nombre' => 'required'
        ]);

        $nuevos_datos = array(
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefonos' => $request->telefonos
        );

        $json = json_encode($nuevos_datos);

        event(new ActualizacionBitacora($oficina->id, Auth::user()->id, 'Edición', $oficina, $json, 'oficinas'));

        $oficina->update($request->all());
        
        return redirect()->route('oficinas.index')->withFlash('La oficina ha sido actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Oficina $oficina, Request $request)
    {
        $oficina->estado_id = 2;
        $oficina->save();

        event(new ActualizacionBitacora($oficina->id, Auth::user()->id, 'Inactivación', '', '', 'oficinas'));

        return Response::json(['success' => 'Éxito']);
    }

    public function activar(Oficina $oficina, Request $request)
    {
        $oficina->estado_id = 1;
        $oficina->save();

        event(new ActualizacionBitacora($oficina->id, Auth::user()->id, 'Activación', '', '', 'oficinas'));

        return Response::json(['success' => 'Éxito']);
    }


    public function getJson(Request $params)
     {

         $api_result['data'] = Oficina::select(
            'oficinas.id',
            'oficinas.nombre',
            'oficinas.direccion',
            'oficinas.telefonos',
            'users.name',
            'estados.estado'
        )->join(
            'users',
            'oficinas.user_id',
            '=',
            'users.id'
        )->join(
            'estados',
            'oficinas.estado_id',
            '=',
            'estados.id'
        )->get();

         return Response::json( $api_result );
     }
}
