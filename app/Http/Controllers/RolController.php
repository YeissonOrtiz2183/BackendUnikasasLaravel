<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use App\Models\Audit;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $roles = Rol::where('nombre_rol', 'LIKE', '%'.$request->search.'%')->paginate(10);
        }else{
            $roles = Rol::All();
        }
        return view('roles.inicioRoles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $privilegios = DB::select('SELECT * FROM privilegios');
        return view('roles.crearRol', compact('privilegios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $privilegiosSelected = request()->except(['_token', '_method']);
        $nombreRol = $privilegiosSelected['nombre_rol'];
        $nombreRol = '"'.$nombreRol.'"';

        DB::select('INSERT INTO rols (nombre_rol) values(' .$nombreRol. ');' );

        $id = Rol::max('id');

        $data = $privilegiosSelected['privilegios'];
        foreach ($data as $privilegio) {
            DB::select('INSERT INTO rol_privilegios(rol_id, privilegio_id) VALUES (' .$id. ',' .$privilegio. ');');
        }

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => 1,
            'modulo' => 'rol',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $nombreRol
        ]);

        return redirect('roles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rol = Rol::find($id);
        $privilegios = DB::select('SELECT * FROM privilegios INNER JOIN rol_privilegios ON privilegios.id = rol_privilegios.privilegio_id WHERE rol_privilegios.rol_id = ?', [$id]);
        return view('roles.verRol', compact('rol', 'privilegios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::find($id);

        //Obtener desde la base de datos los privilegios que tiene el rol seleccionado y los que no tiene el rol
        $privilegios = DB::select('SELECT * FROM privilegios INNER JOIN rol_privilegios ON privilegios.id = rol_privilegios.privilegio_id WHERE rol_privilegios.rol_id = ?', [$id]);
        $privilegiosNoAsignados = DB::select('SELECT * FROM privilegios WHERE privilegios.id NOT IN (SELECT privilegio_id FROM rol_privilegios WHERE rol_privilegios.rol_id = ?)', [$id]);
        return view('roles.modificarRol', compact('rol', 'privilegios', 'privilegiosNoAsignados'));

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
        DB::select('DELETE FROM rol_privilegios WHERE rol_id = ' .$id);
        $privilegiosSelected = request()->except(['_token', '_method']);
        $nombreRol = $privilegiosSelected['nombre_rol'];
        $nombreRol = '"'.$nombreRol.'"';
        $data = $privilegiosSelected['privilegios'];
        foreach ($data as $privilegio) {
            DB::select('INSERT INTO rol_privilegios(rol_id, privilegio_id) VALUES (' .$id. ',' .$privilegio. ');');
        }

        DB::select('UPDATE rols
                    SET nombre_rol =' .$nombreRol.
                    'WHERE id =' .$id);


        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);
        Audit::insert([
            'user_id' => 1,
            'modulo' => 'rol',
            'tipo_accion' => "modificacion",
            'fecha_accion' => $fechaActual,
            'item' => $nombreRol
        ]);

        return redirect('roles/'. $id);

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
