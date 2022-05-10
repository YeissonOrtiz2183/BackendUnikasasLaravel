<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\Producto;
class CotizacionController extends Controller
{
    public function index(Request $request)
    {
        $cliente = $request->get('cliente');
        $codigo = $request->get('codigo');
        $fecha = $request->get('fecha');
        $estado = $request->get('estado');

        if($cliente != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('nombres_cotizante', 'like', "%$cliente%")->get();
        } else{
            $cotizaciones = Cotizacion::all();
        }

        if($codigo != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('cotizacions.id', 'like', "%$codigo%")->get();
        }

        if($fecha != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('fecha_cotizacion', 'like', "%$fecha%")->get();
        }

        if($estado != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('estado_cotizacion', 'like', "%$estado%")->get();
        }
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

    public function show($id)
    {
        $cotizacion = Cotizacion::findOrfail($id);
        $producto = Producto::findOrfail($cotizacion->producto_id);
        return view('Cotizaciones.visualizarCotizacion.vistaCotizacion', compact('cotizacion', 'producto'));
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
        Cotizacion::destroy($id);
        return redirect('cotizaciones');
    }
}
