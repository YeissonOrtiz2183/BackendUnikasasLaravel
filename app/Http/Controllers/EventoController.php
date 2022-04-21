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
        $datos['eventos'] = Evento::paginate(5);
        return view('ModuloEventos.indexEventos', $datos);
    }

    public function create()
    {
        return view('ModuloEventos.formCrearEvento');
    }

    public function store(Request $request){
        $datosEvento = request()->except('_token');
        // return response()->json($datosEvento);
        // extraer fechas 
        // $fechaEvento = $request->fecha_evento;
        Evento::insert($datosEvento);
        return view('ModuloEventos.indexEventos');
    }
}
