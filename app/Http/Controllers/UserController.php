<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audit;
use App\Models\Rol;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //Verificar si se ingreso texto en el buscador de usuarios y si es así, filtrar los usuarios que coincidan en sus nombre o apellidos con el texto ingresado en el buscador
        if($request->has('search')){
            $usuarios = User::where('primer_nombre', 'LIKE', '%'.$request->search.'%')
            ->orWhere('segundo_nombre', 'LIKE', '%'.$request->search.'%')
            ->orWhere('primer_apellido', 'LIKE', '%'.$request->search.'%')
            ->orWhere('segundo_apellido', 'LIKE', '%'.$request->search.'%')
            ->paginate(30);
        }else{
            $usuarios = User::All();
        }
        return view('usuarios.inicioUsuarios', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = DB::select('SELECT * FROM rols;');
        return view('usuarios.crearUsuario', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosUsuario = request()->except('_token');
        $password = $datosUsuario['numero_documento'];
        $datosUsuario['password'] = bcrypt($password);

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'usuario',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosUsuario['primer_nombre'] ." ". $datosUsuario['segundo_nombre'] ." ". $datosUsuario['primer_apellido'] ." ". $datosUsuario['segundo_apellido']
        ]);

        User::insert($datosUsuario);

        return redirect('usuarios');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        $rol = DB::select('SELECT * FROM rols WHERE id = '.$usuario->rol_id.';');
        return view('usuarios.viewUsuario', compact('usuario', 'rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $rol = DB::select('SELECT * FROM rols WHERE id = '.$usuario->rol_id.';');
        $roles = DB::select('SELECT * FROM rols;');
        return view('usuarios.editarUsuario', compact('usuario', 'rol', 'roles'));
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
        $datosUsuario = request()->except('_token', '_method');
        $password = $datosUsuario['numero_documento'];
        $datosUsuario['password'] = bcrypt($password);
        User::where('id', $id)->update($datosUsuario);

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'usuario',
            'tipo_accion' => "modificacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosUsuario['primer_nombre'] ." ". $datosUsuario['segundo_nombre'] ." ". $datosUsuario['primer_apellido'] ." ". $datosUsuario['segundo_apellido']
        ]);

        return redirect('usuarios/' .$id);
    }

    public function reporteUsuarios(Request $request)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar usuarios')){
            $isAdmin = true;
        }

        if($isAdmin){
            $nombreUsuario = $request->get('searchBar');

            if($nombreUsuario != ''){
                $usuarios = User::join('rols as rol', 'rol.id', '=', 'users.rol_id')
                                ->where('primer_nombre', 'LIKE', '%'.$nombreUsuario.'%')
                                ->get();
            } else {
                $usuarios = User::join('rols as rol', 'rol.id', '=', 'users.rol_id')
                                ->select('users.*', 'rol.nombre_rol')
                                ->get();
            }

            $estadoUsuario = $request->get('estado_usuario');
            $rolUsuario = $request->get('nombre_rol');

            if($rolUsuario != ''){
                $usuarios = User::join('rols as rol', 'rol.id', '=', 'users.rol_id')
                                ->select('users.*', 'rol.nombre_rol')
                                ->where('nombre_rol', 'LIKE', '%'.$rolUsuario.'%')
                                ->get();
            }

            $roles = Rol::all();
            // return dd($usuarios);
            return view('usuarios.crearReporteUsuarios', compact('usuarios', 'roles'));
        } else {
            return redirect()->back();
        }
    }

    public function exportPdfUsuarios(Request $request)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar usuarios')){
            $isAdmin = true;
        }

        if($isAdmin){
            $usuarios = User::join('rols as rol', 'rol.id', '=', 'users.rol_id')
                            ->select('users.*', 'rol.nombre_rol')
                            ->get();
                            
            // return dd($proyectos);                                    
            $usuarios = compact('usuarios');
            $pdf = Pdf::loadView('usuarios.exportPdf', $usuarios);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteUsuarios.pdf');
        } else {
            return redirect()->back();
        }
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
