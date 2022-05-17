<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('usuario_filter') && $request->has('accion_filter') && $request->has('date_filter')) {
            $audits = DB::select('SELECT modulo, tipo_accion, fecha_accion, item, sub_item, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits INNER JOIN users ON audits.user_id = users.id WHERE users.id = ' . $request->usuario_filter. ' AND audits.tipo_accion = ' .'"'.$request->accion_filter.'"'. ' AND audits.fecha_accion = ' .$request->date_filter. ' ORDER BY fecha_accion DESC');
        }else{
            $audits = DB::select('SELECT modulo, tipo_accion, fecha_accion, item, sub_item, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido FROM audits INNER JOIN users ON audits.user_id = users.id ORDER BY fecha_accion DESC');
        }

        $autors = DB::select('SELECT DISTINCT primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, users.id as usuario FROM users LEFT JOIN audits ON audits.user_id = users.id WHERE users.id = audits.user_id');
        return view('auditoria.moduloAuditoriaInicio', compact('audits', 'autors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function show(Audit $audit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function edit(Audit $audit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Audit $audit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Audit  $audit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Audit $audit)
    {
        //
    }
}
