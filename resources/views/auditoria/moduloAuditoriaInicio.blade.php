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
            <form class="searchForm" action="{{ url('auditoria') }}" method="GET">
                <label class="search_parametros" for="itemSearch">Filtrar por: </label>
                <label class="search_parametros" for="itemSearch">Usuario:</label>
                <select class="input-text" type="text" name="usuario_filter" id="searchBar">
                    <option value="none" selected disabled hidden>
                    Seleccione una opción
                    @foreach($autors as $autor)
                    <option value="{{ $autor->usuario }}">{{ $autor->primer_nombre }} {{ $autor->segundo_nombre }} {{ $autor->primer_apellido }} {{ $autor->segundo_apellido }}</option>
                    @endforeach
                </select>

                <label class="search_parametros" for="itemSearch">Acción:</label>
                <select class="input-text" type="text" name="accion_filter" id="searchBar">
                    <option value="none" selected disabled hidden>
                    Seleccione una opción
                    <option value="creacion">Creaciones</option>
                    <option value="modificacion">Modificaciones</option>
                    <option value="suspension">Suspensiones</option>
                    <option value="finalizacion">Finalizaciones</option>
                    <option value="reactivacion">Reactivaciones</option>
                </select>

                <label class="search_parametros">Fecha:</label>
                <input class="input-text" type="date" name="date_filter" id="searchBar">

                <input type="submit" value="Buscar">
            </form>
            <div class="container">
                <aside>
                    <div class="button">
                        <a class="buttonCreateReporte" href="crearReporteAuditoria.html">Crear reporte</a>
                    </div>
                </aside>
                <main class="auditoria">
                    @foreach($audits as $audit)
                    <section>
                        <div class="contenedor">
                            <div class="section__infoAuditoria">
                                @if($audit->tipo_accion == 'creacion')
                                    @if($audit->modulo == 'actividad')
                                    <h2 class="info media_esposive"><span>Creación de la {{ $audit->modulo }}: {{$audit->item }} dentro del proyecto {{ $audit->sub_item }}</span></h2>
                                    @else
                                    <h2 class="info media_esposive"><span>Creación del {{ $audit->modulo }}: {{$audit->item }}</span></h2>
                                    @endif

                                @elseif($audit->tipo_accion == 'modificacion')
                                    @if($audit->modulo == 'actividad')
                                    <h2 class="info media_esposive"><span>Modificación de la {{ $audit->modulo }}: {{$audit->item }} dentro del proyecto {{ $audit->sub_item }}</span></h2>
                                    @else
                                    <h2 class="info media_esposive"><span>Modificación del {{ $audit->modulo }}: {{$audit->item }}</span></h2>
                                    @endif

                                @elseif($audit->tipo_accion == 'suspension')
                                <h2 class="info media_esposive"><span>Suspensión del {{ $audit->modulo }}: {{$audit->item }}</span></h2>

                                @elseif($audit->tipo_accion == 'finalizacion')
                                <h2 class="info media_esposive"><span>Finalización del {{ $audit->modulo }}: {{$audit->item }}</span></h2>

                                @elseif($audit->tipo_accion == 'reactivacion')
                                <h2 class="info media_esposive"><span>Reactivación del {{ $audit->modulo }}: {{$audit->item }}</span></h2>

                                @endif

                                <h4 class="info">Fecha: <span>{{ $audit->fecha_accion }}</span></h4>
                                <h4 class="info">Autor: <span>{{ $audit->primer_nombre }} {{ $audit->segundo_nombre }} {{ $audit->primer_apellido }} {{ $audit->segundo_apellido }}</span></h4>
                            </div>
                        </div>
                    </section>
                    @endforeach
                </main>
            </div>

        </main>
    </body>
    </html>
@endsection
