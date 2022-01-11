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
use App\Empresa;
use App\Events\ActualizacionBitacora;
use Validator;


class EmpresasController extends Controller
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
        return view ("admin.empresas.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.empresas.create");
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
        $empresa = Empresa::create($data);
        $empresa->estado_id = 1;
        $empresa->user_id = Auth::user()->id;
        $empresa->save();
       
        event(new ActualizacionBitacora($empresa->id, Auth::user()->id,'Creación','', $empresa,'empresas'));
        return redirect()->route('empresas.index')->withFlash('La empresa ha sido creado exitosamente!');
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
    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empresa $empresa)
    {
        $this->validate($request, [
            'nombre_empresa' => 'required'
        ]);

        $nuevos_datos = array(
            'nombre_empresa' => $request->nombre_empresa,
            'direccion_empresa' => $request->direccion_empresa,
            'telefono_empresa' => $request->telefono_empresa
        );

        $json = json_encode($nuevos_datos);

        event(new ActualizacionBitacora($empresa->id, Auth::user()->id, 'Edición', $empresa, $json, 'empresas'));

        $empresa->update($request->all());
        
        return redirect()->route('empresas.index')->withFlash('La empresa ha sido actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empresa $empresa, Request $request)
    {
        $empresa->estado_id = 2;
        $empresa->save();

        event(new ActualizacionBitacora($empresa->id, Auth::user()->id, 'Inactivación', '', '', 'Empresas'));

        return Response::json(['success' => 'Éxito']);
    }


    public function activar(Empresa $empresa, Request $request)
    {
        $empresa->estado_id = 1;
        $empresa->save();

        event(new ActualizacionBitacora($empresa->id, Auth::user()->id, 'Activación', '', '', 'Empresas'));

        return Response::json(['success' => 'Éxito']);
    }


    public function getJson(Request $params)
     {

         $api_result['data'] = Empresa::select(
            'empresas.id',
            'empresas.nombre_empresa',
            'empresas.direccion_empresa',
            'empresas.telefono_empresa',
            'users.name',
            'estados.estado'
        )->join(
            'users',
            'empresas.user_id',
            '=',
            'users.id'
        )->join(
            'estados',
            'empresas.estado_id',
            '=',
            'estados.id'
        )->get();

         return Response::json( $api_result );
     }
}
