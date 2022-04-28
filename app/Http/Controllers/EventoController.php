<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
class EventoController extends Controller
{
    //
    public function index(Request $request)
    {    
        $eventoBusqueda = $request->get('searchBar');
        $campoTabla = $request->get('campoBusqueda');

        if($eventoBusqueda != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->where('nombre_evento', 'like', "%$eventoBusqueda%")->get();
        } else {
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->get();
        }

        if($eventoBusqueda != '' && $campoTabla != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->where($campoTabla, 'like', "%$eventoBusqueda%")->get();
        }

        return view('ModuloEventos.indexEventos', compact('eventos'));
    }

    public function create()
    {
        // variable proyectos para mostrar los proyectos existentes en el formulario de creacion
        $proyectos = DB::table('proyectos')->get();
        return view('ModuloEventos.formCrearEvento', compact('proyectos'));
    }

    public function store(Request $request)
    {
        $datosEvento = request()->except('_token');
        // return response()->json($datosEvento);
        Evento::insert($datosEvento);
        return redirect('ModuloEventos')->with('mensaje', 'El evento se agrego exitosamente');
    }

    public function show($id)
    {
        $evento = Evento::findOrfail($id);
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        // return dd($proyecto);
        return view('ModuloEventos.visualizarEvento', compact('evento', 'proyecto'));
    }

    public function edit($id)
    {
        $evento = Evento::findOrfail($id);
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        return view('ModuloEventos.modificarEvento', compact('evento','proyecto'));
    }

    public function update(Request $request, $id)
    {
        $datosEvento = request()->except(['_token','_method', "eventName", "eventDate", "eventTime", "eventProyect", "eventAssistant", "eventReason"]);
        Evento::where('id', '=', $id)->update($datosEvento);
        // $evento = Evento::findOrFail($id);
        return redirect('ModuloEventos')->with('mensaje', 'El evento ha sido modificado');
    }

    public function cancel($id)
    {
        $evento = Evento::findOrfail($id);
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        // return dd($evento);
        return view('ModuloEventos.formCancelarEvento', compact('evento','proyecto'));
    }

    public function reporteEventos(Request $request)
    {
        $eventoNombre = $request->get('searchBar');
        $eventoFechaI = $request->get('fechaInicial');
        $eventoFechaF = $request->get('fechaFinal');

        if($eventoNombre != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->where('nombre_evento', 'like', "%$eventoNombre%")->get();
        } else {
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->get();
        }

        if($eventoFechaI != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->where('fecha_evento', 'like', "%$eventoFechaI%")->get();
        }

        if($eventoFechaI != '' && $eventoFechaF != ''){
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.proyecto_id')->select('*')->whereDate('fecha_evento', '>=', "$eventoFechaI%")->whereDate('fecha_evento', '<=', "$eventoFechaF%")->get();
        }

        return view('ModuloEventos.crearReporteEvent', compact('eventos'));
    }

    public function disponibilidad()
    {
        return view('ModuloEventos.disponibilidad');
    }
}
