<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;

class CotizacionController extends Controller
{
    public function index()
    {
        $cotizaciones = Cotizacion::all();
        return view('Cotizaciones.cotizaciones', compact('cotizaciones'));
    }

    public function create()
    {
        return view('Cotizaciones.CrearCotizacion.crearCotizacion');
    }

    public function edit($id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        // return dd($cotizacion);
        return view('Cotizaciones.editarCotizacion.editarCotizacion', compact('cotizacion'));
    }

    public function store(Request $request)
    {
        $cotizacion = request()->except('_token');
        // return response()->json($datosEvento);
        Cotizacion::insert($cotizacion);
        return redirect('cotizaciones');
    }

    public function update(Request $request, $id)
    {
        $datosCotizacion = request()->except(['_token','_method']);
        Cotizacion::where('id', '=', $id)->update($datosCotizacion);
        // $evento = Evento::findOrFail($id);
        return redirect('cotizaciones');
    }

    public function destroy($id)
    {
        $cotizacion = Cotizacion::findOrFail($id);
        return redirect('cotizacion');
    }
}
