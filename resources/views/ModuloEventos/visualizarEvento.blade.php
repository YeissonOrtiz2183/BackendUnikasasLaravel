<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar evento</title>
    <link rel="stylesheet" href="{{ asset('css/Eventos/visualizarEvento.css') }}">
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
                <div class="contenedor-campos contenedor">
                    <div class="section__infoEvento">
                        <h2 class="info block info2">Nombre:&nbsp;<span>{{ $evento->nombre_evento }}</span></h2>
                        <h4 class="info info2">Fecha: <span>{{ date('d - m - Y', strtotime($evento->fecha_evento)) }}</span></h4>
                        <h4 class="info info2">Horario: <span>{{ date('h:i A', strtotime($evento->hora_inicio)) }} {{' - '.date('h:i A', strtotime($evento->hora_fin)) }}</span></h4>
                        <h4 class="info info2">Proyecto: <span>{{ $proyecto->nombre_proyecto}}</span></h4>
                        <h4 class="info info2">Notificación: <span>{{ $evento->notificacion_evento }}</span></h4>
                        <h4 class="info info2">Asistentes: <span>{{ $evento->invitados_evento }}</span></h4>
                        <h4 class="info info2">Lugar: <span>{{ $evento->lugar_evento }}</span></h4>
                        <h4 class="info info2">Asunto: <span>{{ $evento->asunto_evento }}</span></h4>
                        <h4 class="info info2">Mensaje: <span>{{ $evento->mensaje_evento }}</span></h4>
                        <h4 class="info info2">Estado del evento: <span>{{ $evento->estado_evento }}</span></h4>
                    </div>
        
                    <div class="botones">
                        <a href="{{ url('ModuloEventos/'.$evento->id.'/edit')}}"><input type="button" value="Modificar evento" class="modificar"></a>
                        <a href="{{ url('ModuloEventos/'.$evento->id.'/cancel') }}"><input type="button" value="Cancelar evento" class="cancelar"></a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</body>
</html>