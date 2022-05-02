<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/proyectos/viewProyecto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/proyectos/viewActividad.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Proyecto</title>
</head>
<body>
<section class="modal">
            <div class="modal__content modalActivity">
                <div class="iconClose">
                    <span class="material-icons closeIcon" onclick="history.back()">highlight_off</span>
                </div>
                <div class="modal__content--contenedor">
                    
                    <h2>{{ $actividad->nombre_actividad }}</h2>
                    <div class="infoActividad">
                        <div class="data1">
                            <b>Encargado:</b>
                            <b>{{ $actividad->encargado_actividad }}</b>
                            <b>Objetivo:</b>
                            <b>{{ $actividad->objetivo_actividad }}</b>
                            <b>Fecha inicio:</b>
                            <b>{{ $actividad->fecha_inicio }}</b>
                            <b>Fecha fin:</b>
                            <b>{{ $actividad->fecha_fin }}</b>
                            <b>Observaciones:</b>
                            <b>{{ $actividad->observaciones_actividad }}</b>
                            <b>Estado:</b>
                            <b>{{ $actividad->estado_actividad }}</b>
                        </div>
                    </div>
                    <div class="botones">
                        <button class="save" type="button">Completar actividad</button>
                        <a><span class="material-icons edit">edit</span></a>
                    </div>
                </div>
            </div>
        </section>
</body>