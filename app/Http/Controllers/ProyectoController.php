<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Proyecto;
use App\Models\Actividad;
use App\Models\ProyectoEtapa;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proyectos['proyectos'] = DB::select('SELECT proyectos.id, proyectos.nombre_proyecto, proyectos.estado_proyecto, proyectos.fecha_inicio, encargado.primer_nombre as encargado_nombre, encargado.primer_apellido as encargado_apellido, cliente.primer_nombre as cliente_nombre, cliente.primer_apellido as cliente_apellido FROM proyectos LEFT JOIN users as encargado ON proyectos.encargado_id = encargado.id LEFT JOIN users as cliente ON proyectos.cliente_id = cliente.id WHERE estado_proyecto = "En ejecucion"');
        return view('proyectos.moduloInicioProyecto', $proyectos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyectos.crearProyecto');
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

        Proyecto::insert($datosProyecto);

        header('Location: http://127.0.0.1:8000/proyectos');
        
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
        $proyecto = Proyecto::findOrfail($id);
        $etapas = DB::select('SELECT etapas.nombre_etapa from proyectos INNER JOIN proyecto_etapas as pro ON proyectos.id = pro.proyecto_id INNER JOIN etapas ON pro.etapa_id = etapas.id WHERE proyectos.id = ' .$id);
        $actividades = DB::select('SELECT * from actividads INNER JOIN etapas ON actividads.etapa_id = etapas.id INNER JOIN proyecto_etapas as pro ON etapas.id = pro.etapa_id INNER JOIN proyectos ON pro.proyecto_id = proyectos.id WHERE proyectos.id =' .$id);
        return view('proyectos.viewProyecto', compact('proyecto', 'etapas', 'actividades'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyecto = Proyecto::findOrfail($id);
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

        Proyecto::where('id', '=', $id)->update($datosProyecto);
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
