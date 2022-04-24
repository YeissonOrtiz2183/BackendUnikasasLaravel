<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    //
    public function index(Request $request)
    {
        $eventoBusqueda = $request->get('searchBar');
        $campoTabla = $request->get('campoBusqueda');
        
        $datos['eventos'] = Evento::buscarPor($eventoBusqueda, $campoTabla)->paginate(15);
        
        return view('ModuloEventos.indexEventos', $datos);
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
        // dd($evento);
        return view('ModuloEventos.visualizarEvento', compact('evento'));
    }

    public function edit($id)
    {
        $evento = Evento::findOrfail($id);
        return view('ModuloEventos.modificarEvento', compact('evento'));
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
        return view('ModuloEventos.formCancelarEvento', compact('evento'));
    }
}
