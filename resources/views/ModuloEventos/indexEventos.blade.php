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
                                <time class="dia" datetime="13">13</time> 
                                <time class="fecha" datetime="02-2021">02-2021</time>
                                <time class="hora" datetime="03:00 pm">{{ $evento->hora_inicio. ' - ' .$evento->hora_fin }}</time>
                            </div>
                            <div class="section__infoEvento">
                                <h2 class="info responsive">Nombre evento: <span>{{ $evento->nombre_evento }}</span></h2>
                                <h4 class="info">Lugar: <span>{{ $evento->lugar_evento }}</span></h4>
                                <h4 class="info">Asistentes: <span>{{ $evento->invitados_evento }}</span></h4>
                                <h4 class="info">Proyecto: <span>{{ $evento->proyecto_id }}</span></h4>
                            </div>
                        <a href="{{ url('/visualizarEventos')}}" class="button visualizar">Visualizar</a>
                    </div>
                    
                </section>   @endforeach
                {{-- </section>
                <section>
                    <div class="contenedor">
                        <div class="contenedor-secundario">
                            <time class="dia" datetime="13">13</time> 
                            <time class="fecha" datetime="02-2021">02-2021</time>
                            <time class="hora" datetime="03:00 pm">03:00 - 03:30 pm</time>
                        </div>
                        <div class="section__infoEvento">
                            <h2 class="info responsive">Nombre evento: <span>Reunión de formalización de contrato</span></h2>
                            <h4 class="info">Lugar: <span>Oficinas de la empresa</span></h4>
                            <h4 class="info">Asistentes: <span>Fabio Nelson Fierro Cubillos, Andres Camilo Torres Garzón</span></h4>
                            <h4 class="info">Proyecto: <span>Casa tipo chalet 80m2</span></h4>
                        </div>
                        <a href="visualizarEvento.html" class="button visualizar">Visualizar</a>
                    </div>
                </section>
                <section>
                    <div class="contenedor">
                        <div class="contenedor-secundario">
                            <time class="dia" datetime="13">13</time> 
                            <time class="fecha" datetime="02-2021">02-2021</time>
                            <time class="hora" datetime="03:00 pm">03:00 - 03:30 pm</time>
                        </div>
                        <div class="section__infoEvento">
                            <h2 class="info">Nombre evento: <span class="responsive">Reunión de formalización de contrato</span></h2>
                            <h4 class="info">Lugar: <span>Oficinas de la empresa</span></h4>
                            <h4 class="info">Asistentes: <span>Fabio Nelson Fierro Cubillos, Andres Camilo Torres Garzón</span></h4>
                            <h4 class="info">Proyecto: <span>Casa tipo chalet 80m2</span></h4>
                        </div>
                        <a href="visualizarEvento.html" class="button visualizar">Visualizar</a>
                    </div>
                </section> --}}

            </main>
        </div>
                
    </main>
</body>
</html>