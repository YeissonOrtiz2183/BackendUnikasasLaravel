<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Proyecto;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    //
    public function index(Request $request)
    {
        if($request){
            $eventoBusqueda = $request->get('searchBar');
            $campoTabla = $request->get('campoBusqueda');
            $eventos = Evento::buscarPor($eventoBusqueda, $campoTabla)->paginate(15);
        }
    
        $eventos = Evento::join('proyectos', 'proyectos.id', '=', 'eventos.id')->select('*')->get();
        // return dd($eventos);
        return view('ModuloEventos.indexEventos', compact('eventos'));
    }

    public function create()
    {
        return view('ModuloEventos.formCrearEvento');
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
        $datosEvento = request()->except(['_token','_method']);
        Evento::where('id', '=', $id)->update($datosEvento);
        // $evento = Evento::findOrFail($id);
        return redirect('ModuloEventos')->with('mensaje', 'El evento ha sido modificado');
    }

    public function cancel($id)
    {
        $evento = Evento::findOrfail($id);
        $proyecto = Proyecto::findOrfail($evento->proyecto_id);
        return view('ModuloEventos.formCancelarEvento', compact('evento','proyecto'));
    }
}
