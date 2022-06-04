<?php

namespace App\Http\Controllers;

use App\Mail\emailCancelarEvento;
use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Config;
use App\Models\Cotizacion;

use Illuminate\Support\Facades\Mail;
use App\Mail\emailCrearEvento;

class EventoController extends Controller
{
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

    public $eventosR;
    //
    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $rol = $request->user()->rol_id;
        $email = $request->user()->email;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar eventos') || $privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->get();
        }else{
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where('invitados_evento', 'like', "%$email%")->get();
        }


        $eventoBusqueda = $request->get('searchBar');
        $campoTabla = $request->get('campoBusqueda');

        // if($eventoBusqueda != ''){
        //     $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where('nombre_evento', 'like', "%$eventoBusqueda%")->get();
        // } else {
        //     $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->get();
        // }

        // if($eventoBusqueda != '' && $campoTabla != ''){
        //     $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where($campoTabla, 'like', "%$eventoBusqueda%")->get();
        // }

        return view('Eventos.indexEventos', compact('eventos', 'isAdmin', 'notificaciones'));
    }

    public function create()
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if ($isAdmin) {
            // variable proyectos para mostrar los proyectos existentes en el formulario de creacion
            $proyectos = DB::table('proyectos')->get();
            return view('Eventos.formCrearEvento', compact('proyectos', 'notificaciones'));
        }else{
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $datosEvento = request()->except('_token');
        // return response()->json($datosEvento);
        // dd($datosEvento);
        $email= request('invitados_evento');
        Evento::insert($datosEvento);

        if($email){
            Mail::to($email)->send(new emailCrearEvento($datosEvento));
        }

        return redirect('eventos')->with('mensaje', 'El evento se agrego exitosamente');
    }

    public function show($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $email = auth()->user()->email;
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $isMember = false;
        $canView = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar eventos')){
            $canView = true;
        }

        $evento = Evento::findOrfail($id);

        //Si el evento contiene el $email dentro del campo invitados_evento
        if(strpos($evento->invitados_evento, $email) !== false){
            $isMember = true;
        }

        if($isAdmin || $isMember || $canView){
            // variable proyecto para acceder al proyecto al cual se encuentra asignado el evento
            $proyecto = Proyecto::findOrfail($evento->proyecto_id);
            return view('Eventos.visualizarEvento', compact('evento', 'proyecto', 'notificaciones'));
        }else{
            return redirect()->back();
        }

    }

    public function edit($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if ($isAdmin) {
            $evento = Evento::findOrfail($id);
            $proyecto = Proyecto::findOrfail($evento->proyecto_id);
            return view('Eventos.modificarEvento', compact('evento','proyecto', 'notificaciones'));
        }else{
            return redirect()->back();
        }

    }

    public function update(Request $request, $id)
    {
        $datosEvento = request()->except(['_token','_method', "eventName", "eventDate", "eventTime", "eventProyect", "eventAssistant", "eventReason"]);
        Evento::where('id', '=', $id)->update($datosEvento);

        $respuesta = request('eventReason');
        // dd($respuesta);
        if($respuesta){
            $datos = request()->except(['_token','_method']);
            $email= request('eventAssistant');
            Mail::to($email)->send(new emailCancelarEvento($datos));
        }
        // $evento = Evento::findOrFail($id);
        return redirect('eventos')->with('mensaje', 'El evento ha sido modificado');
    }

    public function cancel($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $evento = Evento::findOrfail($id);
            $proyecto = Proyecto::findOrfail($evento->proyecto_id);

            return view('Eventos.formCancelarEvento', compact('evento','proyecto', 'notificaciones'));
        }else{
            return redirect()->back();
        }
    }

    public function disponibilidad(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $fechaInicial = $request->get('fecha');
        $fechaFinal = $request->get('fechaDos');
        if($fechaInicial != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where('fecha_evento', 'like', "$fechaInicial")->get();
        } else {
            $eventos = Evento::all();
        }

        if($fechaInicial != '' && $fechaFinal != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->whereDate('fecha_evento', '>=', "$fechaInicial")->whereDate('fecha_evento', '<=', "$fechaFinal")->get();
        }
        // dd($eventos);
        return view('Eventos.disponibilidad', compact('eventos', 'notificaciones'));
    }

    public function reporteEventos(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){

            // $request = $request->except('_token');
            // return response()->json($request);
            $eventoNombre = $request->get('searchBar');
            // if($eventoNombre != '')
            //     return response()->json($request->except('_token'));

            $eventoFechaI = $request->get('fechaInicial'); // variables para el filtro de creacion del reporte
            $eventoFechaF = $request->get('fechaFinal');

            if($eventoNombre != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where('nombre_evento', 'like', "%$eventoNombre%")->get();
            } else {
                // $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->get();
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->get();
            }

            if($eventoFechaI != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where('fecha_evento', 'like', "%$eventoFechaI%")->get();
            }

            if($eventoFechaI != '' && $eventoFechaF != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->whereDate('fecha_evento', '>=', "$eventoFechaI%")->whereDate('fecha_evento', '<=', "$eventoFechaF%")->get();
            }

            // filtro campos checkbox
            $eventoNombTable = $request->get('nombre_evento');
            $eventoFechTable = $request->get('fecha_evento');
            $eventoHorITable = $request->get('hora_inicio');
            $eventoHorFTable = $request->get('hora_fin');
            $eventoProyectTable = $request->get('nombre_proyecto');
            $eventoNotifTable = $request->get('notificacion_evento');
            $eventoInvitTable = $request->get('invitados_evento');
            $eventoLugTable = $request->get('lugar_evento');
            $eventoAsuntTable = $request->get('asunto_evento');
            $eventoMensajTable = $request->get('mensaje_evento');
            $eventoEstadTable = $request->get('estado_evento');

            if($eventoNombTable != ''){
                $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable")->get();
                if($eventoFechTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable")->get();
                }
                if($eventoHorITable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable")->get();
                }
                if($eventoHorFTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable")->get();
                }
                if($eventoProyectTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable")->get();
                }
                if($eventoNotifTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable", "$eventoNotifTable")->get();
                }
                if($eventoInvitTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable", "$eventoNotifTable", "$eventoInvitTable")->get();
                }
                if($eventoLugTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable", "$eventoNotifTable", "$eventoInvitTable", "$eventoLugTable")->get();
                }
                if($eventoAsuntTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable", "$eventoNotifTable", "$eventoInvitTable", "$eventoLugTable", "$eventoAsuntTable")->get();
                }
                if($eventoMensajTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable", "$eventoNotifTable", "$eventoInvitTable", "$eventoLugTable", "$eventoAsuntTable", "$eventoMensajTable")->get();
                }
                if($eventoEstadTable != ''){
                    $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id', "$eventoNombTable", "$eventoFechTable", "$eventoHorITable", "$eventoHorFTable", "$eventoProyectTable", "$eventoNotifTable", "$eventoInvitTable", "$eventoLugTable", "$eventoAsuntTable", "$eventoMensajTable", "$eventoEstadTable")->get();
                }
            }

            // $eventosR = $eventos;
            $eventosR = $eventos;

            return view('Eventos.crearReporteEvent', compact('eventos', 'notificaciones'));

        }else{
            return redirect()->back();
        }

    }

    public function exportPdfEventos()
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->get();
            // $eventos = [];
            // $eventos = explode('}', $event);
            // $eventos = Config::get('eventosR');
            // return dd($eventos);
            // $eventos = $this->eventosR;
            $eventos = compact('eventos');
            // return dd($eventos);
            $pdf = Pdf::loadView('Eventos.exportPdf', $eventos);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteEventos.pdf');
        }else{
            return redirect()->back();
        }


    }

    public function destroy($id)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos')){
            $isAdmin = true;
        }

        if($isAdmin){
            Evento::destroy($id);
            return redirect('eventos')->with('mensage','El evento ha sido borrado');
        }else{
            return redirect()->back();
        }
    }
}
