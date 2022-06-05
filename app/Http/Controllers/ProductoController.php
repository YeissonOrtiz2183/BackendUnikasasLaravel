<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       if($request->has('search')){
            $productos = Producto::where('nombre_producto', 'LIKE', '%'.$request->search.'%')
            ->orWhere('id', '=', $request->search)
            ->orWhere('precio_producto', '=', $request->search)
            ->paginate(30);

        }else{
            $productos = Producto::All();
        }
        return view('productos.productosInicio', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.registrarProducto');
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
        $productos = Producto::find($id);
        return view('productos.visualizarProducto', ['producto'=>$productos]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto=Producto::findOrFail($id);
        return view('productos.modificarProducto', compact('producto'));

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
