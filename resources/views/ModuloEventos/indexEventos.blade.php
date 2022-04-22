<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/moduloEventos.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Proyectos Unikasas Eventos</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <h1 class="titleModule">Eventos</h1>
        <form class="searchForm" action="">
            <label for="itemSearch">Buscar evento:</label>
            <input type="text" placeholder="Escriba el nombre del evento" name="searchBar" id="searchBar">
            <input type="submit" value="Buscar">
            <div class="filter">
                <input type="text" class="campomedio" list="encargado" placeholder="Filtrar por:">
                    <datalist id="encargado">
                        <option value="Fecha de creación">
                        <option value="Este mes">
                        <option value="Esta semana">
                        <option value="Hoy">
                    </datalist>
                </div>
        </form>
        <div class="container">
            <aside>
                <div class="button">
                    <a class="buttonCreateEvento" href="{{ url('ModuloEventos/create')}}">Crear evento</a>
                </div>
                <div class="button">
                    <a class="buttonDisponibilidad" href="{{ url('/disponibilidad')}}">Disponibilidad</a>
                </div>
                <div class="button">
                    <a class="buttonCreateReporte" href="{{ url('/reporteEventos')}}">Crear reporte</a>
                </div>
            </aside>
            <main class="eventos">
                @foreach ($eventos as $evento)
                <section>
                    <div class="contenedor">
                            <div class="contenedor-secundario">
                                <time class="dia">{{ date('d', strtotime($evento->fecha_evento)) }}</time> 
                                <time class="fecha">{{ date('m - Y', strtotime($evento->fecha_evento)) }}</time>
                                <time class="hora">{{ date('h:i', strtotime($evento->hora_inicio)) }} {{' - '.date('h:i', strtotime($evento->hora_fin)) }}</time>
                            </div>
                            <div class="section__infoEvento">
                                <h2 class="info responsive">Nombre evento: <span>{{ $evento->nombre_evento }}</span></h2>
                                <h4 class="info">Lugar: <span>{{ $evento->lugar_evento }}</span></h4>
                                <h4 class="info">Asistentes: <span>{{ $evento->invitados_evento }}</span></h4>
                                <h4 class="info">Proyecto: <span>{{ $evento->proyecto_id }}</span></h4>
                            </div>
                        <a href="{{ url('/ModuloEventos/'.$evento->evento_id.'/show') }}" class="button visualizar">Visualizar</a>
                    </div> 
                </section>
                @endforeach

            </main>
        </div>
                
    </main>
</body>
</html>