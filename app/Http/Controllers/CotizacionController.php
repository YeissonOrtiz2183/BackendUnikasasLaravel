<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cotizacion;
use App\Models\Producto;
use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Support\Facades\Mail;
use App\Mail\emailCrearCotizacion; // Para la creacion dela cotzación
use App\Mail\emailContestarCotizacion; // Para la respuesta a la cotización

class CotizacionController extends Controller
{
    public function index(Request $request)
    {
        $rol = $request->user()->rol_id;
        $isAdmin = false;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones')) {
            $isAdmin = true;
        }

        $cliente = $request->get('cliente');
        $codigo = $request->get('codigo');
        $fecha = $request->get('fecha');
        $estado = $request->get('estado');

        if($cliente != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('nombres_cotizante', 'like', "%$cliente%")->paginate(10);
        } else{
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->paginate(10);
        }

        if($codigo != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('cotizacions.id', 'like', "$codigo")->paginate(10);
        }

        if($fecha != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('fecha_cotizacion', 'like', "%$fecha%")->paginate(10);
        }

        if($estado != ''){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->where('estado_cotizacion', 'like', "%$estado%")->paginate(10);
        }
        return view('Cotizaciones.cotizaciones', compact('cotizaciones', 'isAdmin'));
    }

    public function create()
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones')) {
            $isAdmin = true;
        }

        if($isAdmin){
            $productos = Producto::all();
            return view('Cotizaciones.CrearCotizacion.crearCotizacion', compact('productos'));
        }else{
            return redirect()->back();
        }


    }

    public function edit($id)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones')) {
            $isAdmin = true;
        }

        if($isAdmin){
            $cotizacion = Cotizacion::findOrFail($id);
            $producto = Producto::findOrfail($cotizacion->producto_id);
            $productos = Producto::all();

            return view('Cotizaciones.editarCotizacion.editarCotizacion', compact('cotizacion', 'producto', 'productos'));
        }else{
            return redirect()->back();
        }

    }

    public function store(Request $request)
    {
        $cotizacion = request()->except('_token');
        $email= request('email_cotizante');
        Cotizacion::insert($cotizacion);
        // obtener id para enviar al correo del cliente
        $cotizacionEmail = Cotizacion::latest('id')->first();
        // Enviar email de la cotización
        if($email){
            Mail::to($email)->send(new emailCrearCotizacion($cotizacionEmail));
        }
        // return response()->json($datosEvento);
        return redirect('cotizaciones');
    }

    public function show($id)
    {
        $rol = auth()->user()->rol_id;
        $canView = false;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones') || $privilegios->contains('nombre_privilegio', 'Consultar cotizaciones')) {
            $canView = true;
        }

        if($canView){
            $cotizacion = Cotizacion::findOrfail($id);
            $producto = Producto::findOrfail($cotizacion->producto_id);
            return view('Cotizaciones.visualizarCotizacion.vistaCotizacion', compact('cotizacion', 'producto'));
        }else{
            return redirect()->back();
        }


    }

    public function update(Request $request, $id)
    {
        $datosCotizacion = request()->except(['_token','_method', 'respuesta_cotizacion']);
        Cotizacion::where('id', '=', $id)->update($datosCotizacion);

        // envio de correo de respuesta de cotización
        $respuesta = request('respuesta_cotizacion');
        if($respuesta){
            $datosCotizacion = request()->except(['_token','_method']);
            $email= request('email_cotizante');
            Mail::to($email)->send(new emailContestarCotizacion($datosCotizacion));
        }
        // $evento = Evento::findOrFail($id);
        return redirect('cotizaciones');
    }

    public function contestarCotizacion($id)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones')) {
            $isAdmin = true;
        }

        if($isAdmin){
            $cotizacion = Cotizacion::findOrFail($id);
            $producto = Producto::findOrfail($cotizacion->producto_id);
            return view('Cotizaciones.contestarCotizacion.contestarCotizacion', compact('cotizacion', 'producto'));
        }else{
            return redirect()->back();
        }

    }

    public function exportPdfCotizaciones()
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones')) {
            $isAdmin = true;
        }

        if($isAdmin){
            $cotizaciones = Cotizacion::join('productos', 'productos.id', '=', 'cotizacions.producto_id')->select('cotizacions.id', 'nombres_cotizante', 'apellidos_cotizante', 'email_cotizante', 'telefono_cotizante', 'ciudad_cotizante', 'ubicacion_cotizante', 'fecha_cotizacion', 'comentarios_cotizacion', 'estado_cotizacion', 'nombre_producto', 'descripcion_producto', 'precio_producto')->get();
            $cotizaciones = compact('cotizaciones');

            $pdf = Pdf::loadView('cotizaciones.pdf.exportPdf', $cotizaciones);
            return $pdf->setPaper('a3', 'landscape')->stream('reporteCotizaciones.pdf');
        }else{
            return redirect()->back();
        }


    }

    public function destroy($id)
    {
        $rol = auth()->user()->rol_id;
        $isAdmin = false;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones')) {
            $isAdmin = true;
        }

        if($isAdmin){
            Cotizacion::destroy($id);
            return redirect('cotizaciones');
        }else{
            return redirect()->back();
        }

    }
}
