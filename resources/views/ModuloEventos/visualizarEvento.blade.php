<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar evento</title>
    <link rel="stylesheet" href="{{ asset('css/visualizarEvento.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
</head>
<body>
    <div class="main">
        <div class="top">
            <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            <h1 class="titleModule">Visualizar evento</h1>
        </div>
        <div class="">
            <form action="" method="post">
                @csrf
                @foreach ($evento as $event)
                <div class="contenedor-campos contenedor">
                    <div class="section__infoEvento">
                        <h2 class="info block">Nombre:&nbsp;<span>{{ $event->nombre_evento }}</span></h2>
                        <h4 class="info">Fecha: <span>{{ date('d - m - Y', strtotime($event->fecha_evento)) }}</span></h4>
                        <h4 class="info">Horario: <span>{{ date('h:i', strtotime($event->hora_inicio)) }} {{' - '.date('h:i', strtotime($evento->hora_fin)) }}</span></h4>
                        <h4 class="info">Proyecto: <span>{{ $event->proyecto_id}}</span></h4>
                        <h4 class="info">Notificación: <span>{{ $event->notificacion_evento }}</span></h4>
                        <h4 class="info">Asistentes: <span>{{ $event->invitados_evento }}</span></h4>
                        <h4 class="info">Lugar: <span>{{ $event->lugar_evento }}</span></h4>
                        <h4 class="info">Asunto: <span>{{ $event->asunto_evento }}</span></h4>
                        <h4 class="info">Mensaje: <span>{{ $event->mensaje_evento }}</span></h4>
                    </div>
                @endforeach
                    <div class="botones">
                        <a href="modificarEvento.html"><input type="button" value="Modificar evento" class="modificar"></a>
                        <a href="formularioCancelarEvento.html"><input type="button" value="Cancelar evento" class="cancelar" action=""></a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>