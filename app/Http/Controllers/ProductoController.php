<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cotizacion;
use App\Models\Evento;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeNotifications($userId){
        $rol = $userId->rol_id;
        $email = $userId->email;
        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isCotizacionAdmin = false;
        $isEventoAdmin = false;
        if($privilegios->contains('nombre_privilegio', 'Administrar cotizaciones') || $privilegios->contains('nombre_privilegio', 'Consultar cotizaciones')){
            $isCotizacionAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Administrar eventos') || $privilegios->contains('nombre_privilegio', 'Consultar eventos')){
            $isEventoAdmin = true;
        }

        if($isCotizacionAdmin && $isEventoAdmin){
            $cotizaciones = Cotizacion::where('estado_cotizacion', '=', 'Por responder')->get();
            $numCotizaciones = $cotizaciones->count();
            $eventos = Evento::where('fecha_evento', '=', date('Y-m-d'))->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
            if ($numCotizaciones > 0) {
                $notificaciones[] = array('tipo' => 'Cotizaciones', 'cantidad' => $numCotizaciones);
            }

        }else{
            $eventos = Evento::where('invitados_evento', 'like', "%$email%")->get();
            $numEventos = $eventos->count();
            $notificaciones = array();
            if ($numEventos > 0) {
                $notificaciones[] = array('tipo' => 'Eventos', 'cantidad' => $numEventos);
            }
        }
        return $notificaciones;
    }

    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());

       if($request->has('search')){
            $productos = Producto::where('nombre_producto', 'LIKE', '%'.$request->search.'%')
            ->orWhere('id', '=', $request->search)
            ->orWhere('precio_producto', '=', $request->search)
            ->paginate(30);

        }else{
            $productos = Producto::All();
        }
        return view('productos.productosInicio', compact('productos', 'notificaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        return view('productos.registrarProducto', compact('notificaciones'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProducto=request()->except('_token');
        dd($datosProducto['images']);
        if($request->hasFile('foto_producto')){
            $datosProducto['foto_producto']=$request->file('foto_producto')->store('uploads', 'public');
        }

        Producto::insert($datosProducto);
        return response()->json($datosProducto);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $productos = Producto::find($id);
        return view('productos.visualizarProducto', ['producto'=>$productos], compact('notificaciones'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $producto=Producto::findOrFail($id);
        return view('productos.modificarProducto', compact('producto', 'notificaciones'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $datosProducto=request()->except(['_token', '_method']);
        Producto::where('id', '=', $id)->update($datosProducto);

        $producto=Producto::findOrFail($id);
        return redirect('productos/'.$producto->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
