<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios['usuarios'] = User::all();
        return view('usuarios.inicioUsuarios', $usuarios);
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
        $datosUsuario['password_usuario'] = bcrypt($password);
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
        $datosUsuario['password_usuario'] = bcrypt($password);
        User::where('id', $id)->update($datosUsuario);
        return redirect('usuarios/' .$id);
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
