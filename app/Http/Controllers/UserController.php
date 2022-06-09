<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Audit;
use Illuminate\Support\Facades\DB;
use App\Models\Cotizacion;
use App\Models\Evento;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function makeNotifications($userId){
        $rol = $userId->rol_id;
        $email = $userId->email;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isCotizacionAdmin = false;
        $isEventoAdmin = false;
        if($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones') || $privilegios->contains('nombre_privilegio', 'Consultar cotizaciones')){
            $isCotizacionAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos') || $privilegios->contains('nombre_privilegio', 'Consultar eventos')){
            $isEventoAdmin = true;
        }

        if($isCotizacionAdmin && $isEventoAdmin){
            $cotizaciones = Cotizacion::where('estado_cotizacion', '=', 'Por responder')->get();
            $numCotizaciones = $cotizaciones->count();
            $eventos = Evento::where('fecha_evento', '=', date('Y-m-d'))->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
            if ($numCotizaciones > 0) {
                $notificaciones[] = array('tipo' => 'Cotizaciones', 'cantidad' => $numCotizaciones);
            }

        }else{
            $eventos = Evento::where('invitados_evento', 'like', "%$email%")->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
        }


        return $notificaciones;
    }

    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $rol = auth()->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isUserAdmin = false;
        $isRolAdmin = false;
        $canViewUsers = false;
        $canViewRoles = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar usuarios')){
            $isUserAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar usuarios')){
            $canViewUsers = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Administrar roles')){
            $isRolAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar roles')){
            $canViewRoles = true;
        }

        if($isUserAdmin || $canViewUsers){
            if($request->has('search')){
                $usuarios = User::where('primer_nombre', 'LIKE', '%'.$request->search.'%')
                ->orWhere('segundo_nombre', 'LIKE', '%'.$request->search.'%')
                ->orWhere('primer_apellido', 'LIKE', '%'.$request->search.'%')
                ->orWhere('segundo_apellido', 'LIKE', '%'.$request->search.'%')
                ->paginate(30);
            }else{
                $usuarios = User::All();
            }
            return view('usuarios.inicioUsuarios', compact('usuarios', 'isUserAdmin', 'canViewUsers', 'isRolAdmin', 'canViewRoles', 'notificaciones'));
        }else{
            $usuarios = User::where('id', auth()->user()->id)->get();
            return view('usuarios.inicioUsuarios', compact('usuarios', 'isUserAdmin', 'canViewUsers', 'isRolAdmin', 'canViewRoles', 'notificaciones'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $rol = auth()->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isUserAdmin = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar usuarios')){
            $isUserAdmin = true;
        }

        if($isUserAdmin){
            $roles = DB::select('SELECT * FROM rols;');
            return view('usuarios.crearUsuario', compact('roles', 'notificaciones'));
        }else{
            return redirect()->back();
        }
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
        $notificaciones = $this->makeNotifications(auth()->user());

        $userId = auth()->user()->id;
        $rol = auth()->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isUserAdmin = false;
        $canViewUsers = false;
        $isMe = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar usuarios')){
            $isUserAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar usuarios')){
            $canViewUsers = true;
        }

        if($userId == $id){
            $isMe = true;
        }

        if($isUserAdmin || $canViewUsers || $isMe){
            $usuario = User::findOrFail($id);
            $rol = DB::select('SELECT * FROM rols WHERE id = '.$usuario->rol_id.';');
            return view('usuarios.viewUsuario', compact('usuario', 'isUserAdmin', 'canViewUsers', 'isMe', 'rol', 'notificaciones'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $userId = auth()->user()->id;
        $rol = auth()->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isUserAdmin = false;
        $canViewUsers = false;
        $isMe = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar usuarios')){
            $isUserAdmin = true;
        }

        if($userId == $id){
            $isMe = true;
        }

        if($isUserAdmin || $isMe){
            $usuario = User::findOrFail($id);
            $rol = DB::select('SELECT * FROM rols WHERE id = '.$usuario->rol_id.';');
            $roles = DB::select('SELECT * FROM rols;');
            return view('usuarios.editarUsuario', compact('usuario', 'rol', 'roles', 'isUserAdmin', 'isMe', 'notificaciones'));
        }else{
            return redirect()->back();
        }
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

    public function reporteUsuarios()
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
            $usuarios = User::all();
            // return dd($usuarios);
            return view('usuarios.crearReporteUsuarios', compact('usuarios'));
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
            $usuarios = User::all();
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
