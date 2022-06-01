@extends('layouts.layout')

@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="{{ asset('css/proyectos/cearReporteProyectos.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <title>Crear reporte de Usuarios</title>
    </head>
    <body>
        <!--Area de trabajo-->
        <div class="global">
        <main class="workspace">
            <div class="top">
                <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
                <h1 class="titleModule">Crear reporte de Usuarios</h1>
            </div>
            <form class="searchForm" action="" method="get">
                @csrf
                <label class="search_parametros" for="itemSearch">Filtrar por / </label>
                <label class="search_parametros" for="itemSearch">Nombre del proyecto:</label>
                    <select class="input-text" type="text" name="searchBar" id="searchBar">
                        <option value="null" selected disabled hidden>Seleccione el nombre del usuario</option>
                @foreach ($proyectos as $proyecto )
                        <option value="{{ $proyecto->nombre_proyecto  }}">{{ $proyecto->nombre_proyecto }}</option>
                @endforeach
                    </select>

                <label class="search_parametros" for="fechaInicial">Fecha inicial:</label>
                <input type="date" id="fechaInicial" name="fechaInicial">Fecha final:
                <input type="date" id="fechaFinal" name="fechaFinal">


            <div class="container">
                    <div class="formulario">
                        @csrf
                        <h2 class="formulario__titulo">Seleccionar campos</h2>
                        <div class="contenedor-campos contenedor-campos2">
                            <div class="campo">
                                <label>Nombre:</label>
                                <input class="checkbox" type="checkbox" id="nombreProyecto" name="nombre_proyecto" value="nombre_proyecto">
                            </div>
                            <div class="campo">
                                <label>Estado proyecto: </label>
                                <input class="checkbox" type="checkbox" id="estadoProyecto" name="estado_proyecto" value="estado_proyecto">
                            </div>
                            <div class="campo">
                                <label>Fecha inicial: </label>
                                <input class="checkbox" type="checkbox" id="fechaInicio" name="fecha_inicio" value="fecha_inicio">
                            </div>
                            <div class="campo">
                                <label>Encargado: </label>
                                <input class="checkbox" type="checkbox" id="encargadoNombre" name="encargado_nombre" value="encargado_nombre">
                            </div>
                            <div class="campo">
                                <label>Cliente: </label>
                                <input class="checkbox" type="checkbox" id="clienteNombre" name="cliente_nombre" value="cliente_nombre">
                            </div>
                        </div>

                        <div class="botones">
                            <input class="generar" type="submit" value="Generar">
                            <input class="cancelar" type="submit" value="Cancelar" src="{{ url('proyectos') }}">
                        </div>
                    </form>
            </div>

            <div class="previsualizacion">
                <div></div>
                <div>
                    <h2 class="titulo_previsualizacion">Previsualización</h2>
                </div>
                <div>
                    <a href="{{ url('/exportPdfProyectos') }}" class="buttonPdf"><span>PDF</span></a>
                </div>
                <div>
                </div>
            </div>

            <div class="contenedor__imagen">
                <div class="container">

                    <table>
                        <tr>@if(isset($proyecto->id))
                                <th>Id </th>
                            @endif
                            @if(isset($proyecto->nombre_proyecto))
                                <th>Nombre </th>
                            @endif
                            @if(isset($proyecto->estado_proyecto))
                                <th>Estado </th>
                            @endif
                            @if(isset($proyecto->fecha_inicio))
                                <th>Fecha inicial </th>
                            @endif
                            @if(isset($proyecto->encargado_nombre))
                                <th>Encargado </th>
                            @endif
                            @if(isset($proyecto->cliente_nombre))
                                <th>Cliente </th>
                            @endif
                        </tr>

                        @foreach ($proyectos as $proyecto)
                            <tr>@if(isset($proyecto->id))
                                    <td>{{ $proyecto->id }}</td>
                                @endif
                                @if(isset($proyecto->nombre_proyecto))
                                    <td>{{ $proyecto->nombre_proyecto }}</td>
                                @endif
                                @if(isset($proyecto->estado_proyecto))
                                    <td>{{ $proyecto->estado_proyecto }}</td>
                                @endif
                                @if(isset($proyecto->fecha_inicio))
                                    <td>{{ $proyecto->fecha_inicio }}</td>
                                @endif
                                @if(isset($proyecto->encargado_nombre))
                                    <td>{{ $proyecto->encargado_nombre }} {{ $proyecto->encargado_apellido }}</td>
                                @endif
                                @if(isset($proyecto->cliente_nombre))
                                    <td>{{ $proyecto->cliente_nombre }} {{ $proyecto->cliente_apellido }}</td>
                                @endif
                        @endforeach
                    </table>
                </div>
            </div>
        </main>
    </div>
    </body>
    </html>
@endsection
