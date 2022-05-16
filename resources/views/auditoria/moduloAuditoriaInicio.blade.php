@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/auditoria/moduloAuditoria.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Proyectos Unikasas Auditoria</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <main class="workspace">
            <h1 class="titleModule">Registro de auditoria</h1>
            <form class="searchForm" action="{{ url('auditoria') }}">
                <label class="search_parametros" for="itemSearch">Filtrar por / </label>
                <label class="search_parametros" for="itemSearch">Usuario:</label>
                <select class="input-text" type="text" name="nombre" id="searchBar">
                    <option value="opcion1" select>Todo</opcion>
                    <option value="opcion2" select>Andres Camilo Garzón Murillo</opcion>
                    <option value="opcion3"select>Juan Felipe Gomez Herrera</opcion>
                </select>

                <label class="search_parametros" for="itemSearch">Acción:</label>
                <select class="input-text" type="text" name="nombre" id="searchBar">
                    <option value="opcion1" select>Todo</opcion>
                        <option value="opcion2" select>Inserción</opcion>
                    <option value="opcion2" select>Modificación</opcion>
                    <option value="opcion3"select>Eliminación</opcion>
                </select>

                <label class="search_parametros" for="itemSearch">Fecha:</label>
                <select class="input-text" type="text" name="nombre" id="searchBar">
                    <option value="opcion1" select>Todo</opcion>
                    <option value="opcion2" select>11/22/2021</opcion>
                    <option value="opcion3"select>12/12/2021</opcion>
                </select>

                <input type="submit" value="Buscar">
            </form>
            <div class="container">
                <aside>
                    <div class="button">
                        <a class="buttonCreateReporte" href="crearReporteAuditoria.html">Crear reporte</a>
                    </div>
                </aside>
                <main class="auditoia">
                    @foreach($audits as $audit)
                    <section>
                        <div class="contenedor">
                            <div class="contenedor-secundario">
                                <span class="material-icons md-100 user_icon">person</span>
                            </div>
                            <div class="section__infoAuditoria">
                                @if($audit->tipo_accion == 'creacion')

                                <h2 class="info media_esposive"><span>Creación del {{ $audit->modulo }}: {{$audit->valor_nuevo }}</span></h2>

                                @elseif($audit->tipo_accion == 'modificacion')
                                <h2 class="info media_esposive"><span>Modificación del {{ $audit->modulo }}: {{$audit->valor_nuevo }}</span></h2>

                                @elseif($audit->tipo_accion == 'suspension')
                                <h2 class="info media_esposive"><span>Suspensión del {{ $audit->modulo }}: {{$audit->valor_nuevo }}</span></h2>

                                @elseif($audit->tipo_accion == 'finalizacion')
                                <h2 class="info media_esposive"><span>Finalización del {{ $audit->modulo }}: {{$audit->valor_nuevo }}</span></h2>

                                @elseif($audit->tipo_accion == 'reactivacion')
                                <h2 class="info media_esposive"><span>Reactivación del {{ $audit->modulo }}: {{$audit->valor_nuevo }}</span></h2>

                                @endif

                                <h4 class="info">Fecha: <span>{{ $audit->fecha_accion }}</span></h4>
                                <h4 class="info">Autor: <span>{{ $audit->primer_nombre }} {{ $audit->segundo_nombre }} {{ $audit->primer_apellido }} {{ $audit->segundo_apellido }}</span></h4>
                            </div>
                            <a href="verMasDetallesAuditoria.html" class="button visualizar">Visualizar</a>
                        </div>
                    </section>
                    @endforeach
                </main>
            </div>

        </main>
    </body>
    </html>
@endsection
