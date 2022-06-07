<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Cotizacion;
use App\Models\Evento;
use App\Models\Audit;

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

    public function getPermissions(){
        $userId = auth()->user()->id;
        $rol = auth()->user()->rol_id;

        $privilegios = \DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        $isProductoAdmin = false;
        $canViewProductos = false;

        if($privilegios->contains('nombre_privilegio', 'Administrar productos')){
            $isProductoAdmin = true;
        }

        if($privilegios->contains('nombre_privilegio', 'Consultar productos')){
            $canViewProductos = true;
        }

        return array('isProductoAdmin' => $isProductoAdmin, 'canViewProductos' => $canViewProductos);
    }

    public function index(Request $request)
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];
        $canViewProductos = $this->getPermissions()['canViewProductos'];

        if($isProductoAdmin || $canViewProductos){
            if($request->has('search')){
                $productos = Producto::where('nombre_producto', 'LIKE', '%'.$request->search.'%')
                ->orWhere('id', '=', $request->search)
                ->orWhere('precio_producto', '=', $request->search)
                ->paginate(30);

            }else{
                //Traer todos los productos seleccionar una imagen por producto. Tablas: productos, product_image, image
                $productos = Producto::all();

                foreach($productos as $producto){
                    $producto->imagen = \DB::table('product_image')
                        ->join('image', 'product_image.image_id', '=', 'image.id')
                        ->select('image.path')
                        ->where('product_image.producto_id', '=', $producto->id)
                        ->first();

                    if(!$producto->imagen){
                        $producto->imagen = 'xd';
                    }else{
                        $producto->imagen = $producto->imagen->path;
                    }
                }
            }
            return view('productos.productosInicio', compact('productos', 'notificaciones', 'isProductoAdmin'));
        }else{
            return redirect()->back();
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notificaciones = $this->makeNotifications(auth()->user());
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];

        if($isProductoAdmin){
            return view('productos.registrarProducto', compact('notificaciones'));
        }else{
            return redirect()->back();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProducto=request()->except('_token', 'images');
        $images = $request->file('images');
        Producto::insert($datosProducto);

        //Iterar sobre $datosProducto['images'] para guardar cada imagen en la carpeta storage/app/public/uploads/productos/
        foreach($images as $image){
            $path = $image->store('uploads', 'public');
            \DB::table('image')->insert([
                'path' => $path,
            ]);

            $image_id = \DB::table('image')->where('path', '=', $path)->first()->id;
            $producto_id = \DB::table('productos')->orderBy('id', 'desc')->first()->id;
            \DB::table('product_image')->insert([
                'producto_id' => $producto_id,
                'image_id' => $image_id,
            ]);

        }

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'productos',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosProducto['nombre_producto']
        ]);

        $producto = Producto::orderBy('id', 'desc')->first();
        return redirect('/productos/'.$producto->id);
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
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];
        $canViewProductos = $this->getPermissions()['canViewProductos'];
        $images = \DB::table('product_image')
            ->join('image', 'product_image.image_id', '=', 'image.id')
            ->select('image.path', 'image.id')
            ->where('product_image.producto_id', '=', $id)
            ->get();

        if($isProductoAdmin || $canViewProductos){
            $productos = Producto::find($id);
            return view('productos.visualizarProducto', ['producto'=>$productos], compact('notificaciones', 'isProductoAdmin', 'images'));
        }else{
            return redirect()->back();
        }
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
        $isProductoAdmin = $this->getPermissions()['isProductoAdmin'];

        if($isProductoAdmin){
            $producto=Producto::findOrFail($id);
            return view('productos.modificarProducto', compact('producto', 'notificaciones'));
        }else{
            return redirect()->back();
        }
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
        $datosProducto=request()->except(['_token', '_method']);
        $datosProductoUp = request()->except(['_token', '_method', 'accion']);

        Producto::where('id', '=', $id)->update($datosProductoUp);

        $producto=Producto::findOrFail($id);

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        if(isset($datosProducto['accion'])){
            $accion = $datosProducto['accion'];
        }else{
            $accion = "modificacion";
        }

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'productos',
            'tipo_accion' => $accion,
            'fecha_accion' => $fechaActual,
            'item' => $producto->nombre_producto
        ]);

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
