<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    //
    public function index()
    {
        $datos['eventos'] = Evento::paginate(10);
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
        return view('ModuloEventos.indexEventos');
    }

    public function show($id)
    {
        $evento = Evento::findOrFail($id);
        return view('ModuloEventos.visualizarEvento', compact('evento'));
        
    }
}
