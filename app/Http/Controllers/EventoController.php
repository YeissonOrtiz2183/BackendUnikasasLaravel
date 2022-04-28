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
        if($request == '' ){
            $eventoBusqueda = $request->get('searchBar');
            $campoTabla = $request->get('campoBusqueda');
            $eventos = Evento::buscarPor($eventoBusqueda, $campoTabla)->paginate(5);
        } else{
            $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.id')->select('*')->get();
        }
        
        return view('ModuloEventos.indexEventos', compact('eventos'));
    }

    public function create()
    {
        // variable proyectos para mostrar los proyectos en el formulario de creacion
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
}
