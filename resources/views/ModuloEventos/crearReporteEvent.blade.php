<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Eventos/cearReporteEventos.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Crear reporte de Eventos</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <div class="top">
            <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            <h1 class="titleModule">Crear reporte de eventos</h1>
        </div>
        <form class="searchForm" action="" method="get">
            @csrf
            <label class="search_parametros" for="itemSearch">Filtrar por / </label>
            <label class="search_parametros" for="itemSearch">Nombre del evento:</label>
                <select class="input-text" type="text" name="searchBar" id="searchBar">
                    <option value="null" selected disabled hidden>Seleccione el nombre del evento</option>
            @foreach ($eventos as $evento )
                    <option value="{{ $evento->nombre_evento  }}">{{ $evento->nombre_evento  }}</option>
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
                            <input class="checkbox" type="checkbox" id="nombreEvento" name="nombre_evento" value="nombre_evento">
                        </div>
                        <div class="campo">
                            <label>Fecha:</label>
                            <input class="checkbox" type="checkbox" id="fechaEvento" name="fecha_evento" value="fecha_evento">
                        </div>
                        <div class="campo">
                            <label>Hora de inicio:</label>
                            <input class="checkbox" type="checkbox" id="fechaInicio" name="hora_inicio" value="hora_inicio">
                        </div>
                        <div class="campo">
                            <label>Hora de finalización:</label>
                            <input class="checkbox" type="checkbox" id="fechaFin" name="hora_fin">
                        </div>
                        <div class="campo">
                            <label>Proyecto:</label>
                            <input class="checkbox" type="checkbox" id="proyecto" name="nombre_proyecto">
                        </div>
                        <div class="campo">
                            <label>Notificación:</label>
                            <input class="checkbox" type="checkbox" id="notificacion" name="notificacion_evento">
                        </div>
                        <div class="campo">
                            <label>Invitados:</label>
                            <input class="checkbox" type="checkbox" id="invitados" name="invitados_evento">
                        </div>
                        <div class="campo">
                            <label>Lugar:</label>
                            <input class="checkbox" type="checkbox" id="lugar" name="lugar_evento">
                        </div>
                        <div class="campo">
                            <label>Asunto:</label>
                            <input class="checkbox" type="checkbox" id="asunto" name="asunto_evento">
                        </div>
                        <div class="campo">
                            <label>Mensaje:</label>
                            <input class="checkbox" type="checkbox" id="mensaje" name="mensaje_evento">
                        </div>
                        <div class="campo">
                            <label>Estado:</label>
                            <input class="checkbox" type="checkbox" id="estado" name="estado_evento">
                        </div>
                        <div class="campo">
                            <label>Seleccionar Todos:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label><i>Generar en:</i></label>
                        </div>
                        <div class="campo">
                            <label for="formato">Pdf:</label>
                            <input class="checkbox" type="checkbox" name="formato" value="formato">
                        </div>
                        <div class="campo">
                            <label for="formato">Excel:</label>
                            <input class="checkbox" type="checkbox" name="formato" value="formato">
                        </div>
                    </div>

                    <div class="botones">
                        <input class="generar" type="submit" value="Generar">
                        <input class="cancelar" type="submit" value="Cancelar" src="{{ url('ModuloEventos') }}">
                    </div>
                </form>
        </div>
        <div class="previsualizacion">
            <h2 class="titulo_previsualizacion">Previsualización</h2>
            <a href="{{ url('/exportPdfEventos/'.$eventos) }}" class="icono_dowload"><svg width="35" height="35" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.9778 4.95556L35.8889 1.22222C35.2889 0.466667 34.3778 0 33.3333 0H6.66667C5.62222 0 4.71111 0.466667 4.08889 1.22222L1.02222 4.95556C0.377778 5.71111 0 6.71111 0 7.77778V35.5556C0 38 2 40 4.44444 40H35.5556C38 40 40 38 40 35.5556V7.77778C40 6.71111 39.6222 5.71111 38.9778 4.95556ZM20 32.2222L7.77778 20H15.5556V15.5556H24.4444V20H32.2222L20 32.2222ZM4.71111 4.44444L6.51111 2.22222H33.1778L35.2667 4.44444H4.71111Z" fill="black"/>
                </svg></a>
        </div>
        <div class="contenedor__imagen">
            <div class="container">

                <table>
                    <tr> @if(isset($evento->id))
                            <th>Id </th>
                        @endif
                        @if(isset($evento->nombre_evento))
                            <th>Nombre </th>
                        @endif
                        @if(isset($evento->fecha_evento))
                            <th>Fecha </th>
                        @endif
                        @if(isset($evento->hora_inicio))
                            <th>Hora inicial </th>
                        @endif
                        @if(isset($evento->hora_fin))
                            <th>Hora final </th>
                        @endif
                        @if(isset($evento->nombre_proyecto))
                            <th>Proyecto </th>
                        @endif
                        @if(isset($evento->notificacion_evento))
                            <th>Notificación </th>
                        @endif
                        @if(isset($evento->invitados_evento))
                            <th>Invitados </th>
                        @endif
                        @if(isset($evento->lugar_evento))
                            <th>Lugar </th>
                        @endif
                        @if(isset($evento->asunto_evento))
                            <th>Asunto </th>
                        @endif
                        @if(isset($evento->mensaje_evento))
                            <th>Mensaje </th>
                        @endif
                        @if(isset($evento->estado_evento))
                            <th>Estado </th>
                        @endif
                    </tr>

                    @foreach ($eventos as $evento)
                        <tr>@if(isset($evento->id))
                                <td>{{ $evento->id }}</td>
                            @endif
                            @if(isset($evento->nombre_evento))
                                <td>{{ $evento->nombre_evento }}</td>
                            @endif
                            @if(isset($evento->fecha_evento ))
                                <td>{{ date('d/m/Y', strtotime($evento->fecha_evento))}}</td>
                            @endif
                            @if(isset($evento->hora_inicio))
                                <td>{{ date('h:i A', strtotime($evento->hora_inicio)) }}</td>
                            @endif
                            @if(isset($evento->hora_fin))
                                <td>{{ date('h:i A', strtotime($evento->hora_fin)) }}</td>
                            @endif
                            @if(isset($evento->nombre_proyecto))
                                <td>{{ $evento->nombre_proyecto }}</td>
                            @endif
                            @if(isset($evento->notificacion_evento))
                                <td>{{ $evento->notificacion_evento }}</td>
                            @endif
                            @if(isset($evento->invitados_evento))
                                <td>{{ $evento->invitados_evento }}</td>
                            @endif
                            @if(isset($evento->lugar_evento))
                                <td>{{ $evento->lugar_evento }}</td>
                            @endif
                            @if(isset($evento->asunto_evento))
                                <td>{{ $evento->asunto_evento }}</td>
                            @endif
                            @if(isset($evento->mensaje_evento))
                                <td>{{ $evento->mensaje_evento }}</td>
                            @endif
                            @if(isset($evento->estado_evento))
                                <td>{{ $evento->estado_evento }}</td></tr>
                            @endif

                    @endforeach
                </table>
            </div>
        </div>
    </main>
</body>
</html>
