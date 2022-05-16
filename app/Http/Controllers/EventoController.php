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

use Illuminate\Support\Facades\Mail;
use App\Mail\emailCrearEvento;

class EventoController extends Controller
{
    private $eventosR;
    //
    public function index(Request $request)
    {
        $eventoBusqueda = $request->get('searchBar'); // variables para el filtro de busqueda
        $campoTabla = $request->get('campoBusqueda');

        if($eventoBusqueda != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where('nombre_evento', 'like', "%$eventoBusqueda%")->get();
        } else {
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->get();
        }

        if($eventoBusqueda != '' && $campoTabla != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('eventos.id','nombre_evento', 'fecha_evento', 'hora_inicio', 'hora_fin', 'nombre_proyecto', 'notificacion_evento', 'invitados_evento', 'lugar_evento', 'asunto_evento', 'mensaje_evento', 'estado_evento')->where($campoTabla, 'like', "%$eventoBusqueda%")->get();
        }

        return view('Eventos.indexEventos', compact('eventos'));
    }

    public function create()
    {
        // variable proyectos para mostrar los proyectos existentes en el formulario de creacion
        $proyectos = DB::table('proyectos')->get();
        return view('Eventos.formCrearEvento', compact('proyectos'));
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
        $evento = Evento::findOrfail($id);
        // variable proyecto para acceder al proyecto al cual se encuentra asignado el evento
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        // return dd($proyecto);
        return view('Eventos.visualizarEvento', compact('evento', 'proyecto'));
    }

    public function edit($id)
    {
        $evento = Evento::findOrfail($id);
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        return view('Eventos.modificarEvento', compact('evento','proyecto'));
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
        $evento = Evento::findOrfail($id);
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        // return dd($evento);
        return view('Eventos.formCancelarEvento', compact('evento','proyecto'));
    }

    public function disponibilidad()
    {
        $eventos = Evento::all();
        // dd($eventos);
        return view('Eventos.disponibilidad', compact('eventos'));
    }

    public function reporteEventos(Request $request)
    {
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

        return view('Eventos.crearReporteEvent', compact('eventos'));
    }

    public function exportPdfEventos()
    {
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
    }

    public function destroy($id)
    {
        Evento::destroy($id);
        return redirect('eventos')->with('mensage','El evento ha sido borrado');
    }
}