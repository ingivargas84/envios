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
use App\Events\ActualizacionBitacora;
use Validator;

class EmpleadosController extends Controller
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
        return view ("admin.empleados.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.empleados.create");
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
        $empleado = Empleado::create($data);
        $empleado->estado_id = 1;
        $empleado->user_id = Auth::user()->id;
        $empleado->save();
       
        event(new ActualizacionBitacora($empleado->id, Auth::user()->id,'Creación','', $empleado,'empleados'));
        return redirect()->route('empleados.index')->withFlash('El empleado ha sido creado exitosamente!');
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
    public function edit(Empleado $empleado)
    {
        return view('admin.empleados.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        $this->validate($request, [
            'nombre_empleado' => 'required'
        ]);

        $nuevos_datos = array(
            'nombre_empleado' => $request->nombre_empleado,
            'direccion_empleado' => $request->direccion_empleado,
            'telefono_empleado' => $request->telefono_empleado,
            'cui_empleado' => $request->cui_empleado
        );

        $json = json_encode($nuevos_datos);

        event(new ActualizacionBitacora($empleado->id, Auth::user()->id, 'Edición', $empleado, $json, 'empleado'));

        $empleado->update($request->all());
        
        return redirect()->route('empleados.index')->withFlash('El empleado ha sido actualizado exitosamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado, Request $request)
    {
        $empleado->estado_id = 2;
        $empleado->save();

        event(new ActualizacionBitacora($empleado->id, Auth::user()->id, 'Inactivación', '', '', 'Empleados'));

        return Response::json(['success' => 'Éxito']);
    }


    public function activar(Empleado $empleado, Request $request)
    {
        $empleado->estado_id = 1;
        $empleado->save();

        event(new ActualizacionBitacora($empleado->id, Auth::user()->id, 'Activación', '', '', 'Empleados'));

        return Response::json(['success' => 'Éxito']);
    }

    
    public function getJson(Request $params)
     {

         $api_result['data'] = Empleado::select(
            'empleados.id',
            'empleados.nombre_empleado',
            'empleados.direccion_empleado',
            'empleados.telefono_empleado',
            'empleados.cui_empleado',
            'users.name',
            'estados.estado'
        )->join(
            'users',
            'empleados.user_id',
            '=',
            'users.id'
        )->join(
            'estados',
            'empleados.estado_id',
            '=',
            'estados.id'
        )->get();

         return Response::json( $api_result );
     }
}
