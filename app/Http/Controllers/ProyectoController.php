<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Actividad;
use App\Models\ProyectoEtapa;
use App\Models\Etapa;
use App\Models\Audit;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $estado)
    {
        if ($estado == 'activo') {
            $estadoFind = ' = "En ejecución"';
        }elseif ($estado == 'inactivo') {
            $estadoFind = ' <> "En ejecución"';
        }

        $rol = $request->user()->rol_id;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();


        if ($privilegios->contains('nombre_privilegio', 'Administrar proyectos')) {
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }


        if($privilegios->contains(function ($value) {
            return $value->nombre_privilegio == 'Consultar proyectos';
        }) || $privilegios->contains(function ($value) {
            return $value->nombre_privilegio == 'Administrar proyectos';
        })){

            $proyectos = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto, proyectos.fecha_inicio,
                                    encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                    cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                    FROM proyectos
                                    LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                    LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                    WHERE estado_proyecto ' .$estadoFind. 'ORDER BY proyectos.fecha_inicio DESC');
        }
        else{

            $proyectos = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto, proyectos.fecha_inicio,
                                    encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                    cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                    FROM proyectos
                                    LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                    LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                    WHERE estado_proyecto '.$estadoFind. ' AND ' .$request->user()->id. ' = cliente_id OR estado_proyecto ' .$estadoFind. ' AND ' .$request->user()->id. ' = encargado_id ORDER BY proyectos.fecha_inicio DESC');
        }

        // if($request->has('search') && $request->has('filtro')){
        //     if (!isset($request->filtro)) {
        //         $request->filtro = 'estado_proyecto';
        //     } elseif (!isset($request->search)) {
        //         $request->search = '';
        //     }

        //     $proyectos = Proyecto::where('nombre_proyecto', 'LIKE', '%'.$request->search.'%')
        //     ->join('users as encargado', 'encargado.id', '=', 'proyectos.encargado_id')
        //     ->join('users as cliente', 'cliente.id', '=', 'proyectos.cliente_id')
        //     ->select('proyectos.*', 'encargado.primer_nombre as encargado_nombre', 'encargado.segundo_nombre as encargado_segundo_nombre', 'encargado.primer_apellido as encargado_apellido', 'encargado.segundo_apellido as encargado_segundo_apellido', 'cliente.primer_nombre as cliente_nombre', 'cliente.segundo_nombre as cliente_segundo_nombre', 'cliente.primer_apellido as cliente_apellido', 'cliente.segundo_apellido as cliente_segundo_apellido')
        //     ->orWhere('encargado.primer_nombre', 'LIKE', '%'.$request->search.'%')
        //     ->orWhere('cliente.primer_nombre', 'LIKE', '%'.$request->search.'%')
        //     ->orWhere('encargado.primer_apellido', 'LIKE', '%'.$request->search.'%')
        //     ->orWhere('cliente.primer_apellido', 'LIKE', '%'.$request->search.'%')
        //     ->orderby($request->filtro, 'asc')
        //     ->paginate(10);

        // }else{

        //     if ($estado == 'activo') {
        //         $estadoFind = '"En ejecución"';
        //     }elseif ($estado == 'inactivo') {
        //         $estadoFind = '"Suspendido" OR estado_proyecto = "Finalizado"';
        //     }

        //     $proyectos = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto, proyectos.fecha_inicio,
        //                                     encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
        //                                     cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
        //                                     FROM proyectos
        //                                     LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
        //                                     LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
        //                                     WHERE estado_proyecto ='.$estadoFind);

        // }

        return view('proyectos.moduloInicioProyecto', compact('proyectos', 'isAdmin'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rol = $request->user()->rol_id;

        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', $rol)
            ->get();

        if ($privilegios->contains('nombre_privilegio', 'Administrar proyectos') || $privilegios->contains('nombre_privilegio', 'Dirigir proyectos')) {
            $encargados = DB::select('SELECT users.id, users.primer_nombre, users.segundo_nombre, users.primer_apellido, users.segundo_apellido
                                    FROM users
                                    LEFT JOIN rols ON rols.id = users.rol_id
                                    WHERE rols.nombre_rol LIKE"%min%"');
            $clientes = DB::select('SELECT users.id, users.primer_nombre, users.segundo_nombre, users.primer_apellido, users.segundo_apellido
                                    FROM users
                                    LEFT JOIN rols ON rols.id = users.rol_id
                                    WHERE rols.nombre_rol LIKE "%liente"');
            $productos = DB::select('SELECT productos.id, productos.nombre_producto, productos.descripcion_producto, productos.precio_producto
                                    FROM productos');

            return view('proyectos.crearProyecto', compact('encargados', 'clientes', 'productos'));
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
        $datosProyecto = request()->except('_token');

        $datosProyecto['producto_id'] = $datosProyecto['producto_id'][0];
        $str = $datosProyecto['cliente_id'];
        $int = (int) filter_var($str, FILTER_SANITIZE_NUMBER_INT);

        $datosProyecto['cliente_id'] = $int;


        Proyecto::insert($datosProyecto);
        $idProyecto = Proyecto::max('id');

        Etapa::insert([
            'nombre_etapa' => 'Planeación, diseño y estructuración',
            'descripcion_etapa' => 'Fase 1',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Compra y alistamiento de materiales esenciales',
            'descripcion_etapa' => 'Fase 2',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Transporte',
            'descripcion_etapa' => 'Fase 3',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Construccion',
            'descripcion_etapa' => 'Fase 4',
        ]);

        Etapa::insert([
            'nombre_etapa' => 'Entrega',
            'descripcion_etapa' => 'Fase 5',
        ]);

        $idEtapa = Etapa::max('id');

        for ($i=1; $i <= 5; $i++) {
            ProyectoEtapa::insert([
                'proyecto_id' => $idProyecto,
                'etapa_id' => $idEtapa]);
            $idEtapa--;
        }

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'proyecto',
            'tipo_accion' => "creacion",
            'fecha_accion' => $fechaActual,
            'item' => $datosProyecto['nombre_proyecto']
        ]);

        header('Location: http://127.0.0.1:8000/proyectos/search/activo');

        exit;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idEncargado = Proyecto::select('encargado_id')->where('id', '=', $id)->get();
        $idCliente = Proyecto::select('cliente_id')->where('id', '=', $id)->get();
        $userId = auth()->user()->id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', auth()->user()->rol_id)
            ->get();

        if ($idEncargado[0]->encargado_id == $userId || $privilegios->contains('nombre_privilegio', 'Administrar proyectos') && $userId != $idCliente[0]->cliente_id) {
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }

        if ($userId == $idEncargado[0]->encargado_id || $userId == $idCliente[0]->cliente_id) {
            $isMember = true;
        }else{
            $isMember = false;
        }

        if ($privilegios->contains('nombre_privilegio', 'Administrar proyectos') || $privilegios->contains('nombre_privilegio', 'Consultar proyectos')) {
            $canView = true;
        }else{
            $canView = false;
        }

        if ($isMember || $canView) {
            $proyecto = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto,
                                proyectos.fecha_inicio, proyectos.ciudad_proyecto, proyectos.direccion_proyecto,
                                proyectos.costo_estimado, proyectos.estado_proyecto, proyectos.fecha_fin,
                                proyectos.costo_final, proyectos.suspension_proyecto, productos.nombre_producto as nombre_producto,
                                encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id
                                WHERE proyectos.id = '.$id);

            $etapas = DB::select('SELECT etapas.id, etapas.nombre_etapa
                                from proyectos
                                INNER JOIN proyecto_etapas as pro ON proyectos.id = pro.proyecto_id
                                INNER JOIN etapas ON pro.etapa_id = etapas.id
                                WHERE proyectos.id = ' .$id. '
                                ORDER BY etapas.id ASC');

            $actividades = DB::select('SELECT actividads.id, actividads.nombre_actividad, actividads.fecha_inicio,
                                    actividads.encargado_actividad, actEtp.etapa_id as etapa_id, actEtp.actividad_id as actividad_id
                                    from actividads
                                    INNER JOIN actividad_etapas as actEtp ON actividads.id = actEtp.actividad_id
                                    INNER JOIN etapas ON actEtp.etapa_id = etapas.id
                                    ORDER BY actividads.id ASC');

            return view('proyectos.viewProyecto', compact('proyecto', 'etapas', 'actividades', 'isAdmin'));
        } else {
            return redirect()->back();
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $idEncargado = Proyecto::select('encargado_id')->where('id', '=', $id)->get();
        $idCliente = Proyecto::select('cliente_id')->where('id', '=', $id)->get();
        $userId = auth()->user()->id;
        $privilegios = DB::table('rol_privilegios')
            ->join('privilegios', 'rol_privilegios.privilegio_id', '=', 'privilegios.id')
            ->select('privilegios.nombre_privilegio')
            ->where('rol_privilegios.rol_id', '=', auth()->user()->rol_id)
            ->get();

        if ($idEncargado[0]->encargado_id == $userId || $privilegios->contains('nombre_privilegio', 'Administrar proyectos') && $userId != $idCliente[0]->cliente_id) {
            $isAdmin = true;
        }else{
            $isAdmin = false;
        }

        if ($isAdmin) {
            $proyecto = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto,
                                proyectos.fecha_inicio, proyectos.ciudad_proyecto, proyectos.direccion_proyecto,
                                proyectos.costo_estimado, proyectos.estado_proyecto, proyectos.fecha_fin,
                                proyectos.costo_final , productos.nombre_producto as nombre_producto,
                                encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido,
                                cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido
                                FROM proyectos
                                LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id
                                LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id
                                INNER JOIN productos on proyectos.producto_id = productos.id
                                WHERE proyectos.id = '.$id);

            $etapas = DB::select('SELECT etapas.id, etapas.nombre_etapa
                                from proyectos
                                INNER JOIN proyecto_etapas as pro ON proyectos.id = pro.proyecto_id
                                INNER JOIN etapas ON pro.etapa_id = etapas.id
                                WHERE proyectos.id = ' .$id. '
                                ORDER BY etapas.id ASC');

            $actividades = DB::select('SELECT actividads.id, actividads.nombre_actividad, actividads.fecha_inicio,
                                    actividads.encargado_actividad, actEtp.etapa_id as etapa_id, actEtp.actividad_id as actividad_id
                                    from actividads
                                    INNER JOIN actividad_etapas as actEtp ON actividads.id = actEtp.actividad_id
                                    INNER JOIN etapas ON actEtp.etapa_id = etapas.id
                                    ORDER BY actividads.id ASC');

            return view('proyectos.editProyecto', compact('proyecto', 'etapas', 'actividades'));
        }else{
            return redirect()->back();
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $datosProyecto = request()->except(['_token', '_method']);

        $nombreProyecto = Proyecto::findOrFail($id);
        $nombreProyecto = $nombreProyecto->nombre_proyecto;

        $fechaActual = date("Y-m-d H:i:s");
        $timestamp = strtotime($fechaActual);
        $time = $timestamp - (5 * 60 * 60);
        $fechaActual = date("Y-m-d H:i:s", $time);

        $accion = $datosProyecto['accion'];

        unset($datosProyecto['accion']);

        Audit::insert([
            'user_id' => auth()->user()->id,
            'modulo' => 'proyecto',
            'tipo_accion' => $accion,
            'fecha_accion' => $fechaActual,
            'item' => $nombreProyecto
        ]);

        Proyecto::where('id', '=', $id)->update($datosProyecto);

        return redirect('/proyectos/' .$id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proyecto = Proyecto::findOrfail($id);
    }
}
