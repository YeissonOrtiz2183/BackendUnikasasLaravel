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
            <form action="">
                <div class="contenedor-campos contenedor">
                    <div class="section__infoEvento">
                        <h2 class="info block">Nombre:&nbsp;<span>Reunión de formalización de contrato</span></h2>
                        <h4 class="info">Fecha: <span>01/02/2022</span></h4>
                        <h4 class="info">Horario: <span>03:00 pm - 03:30 pm</span></h4>
                        <h4 class="info">Proyecto: <span>Proyecto casa tipo chalet 80m2 sector rural Fusagasuga</span></h4>
                        <h4 class="info">Notificación: <span>30 minutos antes</span></h4>
                        <h4 class="info">Asistentes: <span>Fabio Nelson Fierro Cubillos, Andres Camilo Torres Garzón</span></h4>
                        <h4 class="info">Lugar: <span>Oficinas de la empresa</span></h4>
                        <h4 class="info">Asunto: <span>Reunion inicial del proyecto para hablar sobre el proyecto a desarrollar.</span></h4>
                        <h4 class="info">Mensaje: <span>Por favor traer los documentos del contrato y una fotocopia del documento la matricula catastral del terreno en donde se va a realizar el proyecto.</span></h4>
                    </div>

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