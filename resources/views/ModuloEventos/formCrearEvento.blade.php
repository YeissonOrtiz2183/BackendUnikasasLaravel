<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Evento</title>
    <link rel="stylesheet" href="{{ asset('css/Eventos/formularioCrearEvento.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">
        <div class="top">
            <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            <h1 class="titleModule">Crear evento</h1>
        </div>
        <div class="formulario">
            <form action="{{ url('/ModuloEventos') }}" method="post">
                @csrf {{-- token de seguridad para el formulario  --}}
                <div class="contenedor-campos">
                    <h2><strong>Información general del evento</strong></h2>
                    <div class="campo">
                        <label for="eventName" style="padding-right: 2%">Nombre del evento:</label>
                        <div class="inputValidate">
                            <input type="text" placeholder="Nombre del evento..." id="eventName" name="nombre_evento" style="width: 98%;">
                            <span id="eventName_error_message" class="error_form"></span>
                        </div>
                    </div>
                    
                    <div class="campo">
                        <label for="eventDate" style="padding-right: 2%">Fecha:</label>
                        <div class="inputValidate">
                            <input type="date" class="campomedio" id="eventDate" name="fecha_evento">
                            <span id="eventDate_error_message" class="error_form"></span>
                        </div>
                    </div>
                    
                    <div class="campo horario">
                            <label for="eventShedule1" style="padding-right: 8%;">Horario:</label>
                            <div class="inputValidate">
                                <input type="time" class="hora" id="eventShedule1" name="hora_inicio">
                                <span id="eventShedule1_error_message" class="error_form"></span>
                            </div>
                                <label for="eventShedule2" class="horas" >Hasta:</label>
                                <div class="inputValidate">
                                    <input type="time" class="address" id="eventShedule2" name="hora_fin" style="width: 94%;">
                                    <span id="eventShedule2_error_message" class="error_form"></span>
                            </div>
                    </div>

                    <div class="campo">
                        <label for="eventProyect" style="padding-left: 14%;">Proyecto:</label>
                        <div class="inputValidate">
                            <select type="text" class="date" id="eventProyect" name="proyecto_id" style="width: 98%;">
                                    <option value="null" selected disabled hidden>Seleccione el proyecto del evento</option>
                                    <option value="1">casa tipo chalet proyecto 80m2</option>
                                    <option value="2">casa tipo chalet proyecto 90m2</option>
                                    <option value="3">casa tipo chalet proyecto 120m2</option>
                            </select>
                            <span id="eventProyect_error_message" class="error_form"></span>
                        </div>

                        <label for="eventNotification">Notificación:</label>
                        <div class="inputValidate">
                            <select type="input" class="date" id="eventNotification" name="notificacion_evento" style="width: 100%;">
                                    <option value="null" selected disabled hidden>Seleccione una notificación para el evento</option>
                                    <option value="1">5 minutos antes</option>
                                    <option value="2">10 minutos antes</option>
                                    <option value="3">20 minutos antes</option>
                                    <option value="4">30 minutos antes</option>
                                    <option value="5">40 minutos antes</option>
                                    <option value="6">50 minutos antes</option>
                                    <option value="7">1 hora antes</option>
                            </select>
                            <span id="eventNotification_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <h2><strong>Información de los asistentes al evento</strong></h2>
                    <div class="campo">
                        <label for="eventAsisstant" style="padding-right: 3%;">Agregar invitados:</label>
                        <div class="inputValidate">
                            <input type="text" placeholder="Ingrese el nombe o el correo de los invitados..." id="eventAsisstant" name="invitados_evento" style="width: 98%;">
                            <span id="eventAsisstant_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <div class="campo campoCompartido">
                        <label></label>
                        <textarea cols="120" rows="10" readonly placeholder="Aqui se agregaran los invitados del evento..."></textarea>
                    </div>

                    <div class="campo">
                        <label for="eventPlace" style="padding-right: 4%">Lugar:</label>
                        <div class="inputValidate">
                            <input type="text" placeholder="Ingrese aqui el lugar del evento" id="eventPlace" name="lugar_evento" style="width: 98%;">
                            <span id="eventPlace_error_message" class="error_form"></span>
                        </div>
                    </div>
                    
                    <div class="campo campoCompartido">
                        <label for="eventBusiness" style="padding-right: 8%;">Asunto:</label>
                        <div class="inputValidate">
                            <textarea cols="120" rows="10" placeholder="Escriba el asunto del evento..." id="eventBusiness" name="asunto_evento" style="width: 98%;"></textarea>
                            <span id="eventBusiness_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <div class="campo campoCompartido">
                        <label for="eventMessage" style="padding-right: 8%;">Mensaje:</label>
                        <div class="inputValidate">
                            <textarea cols="120" rows="10" placeholder="Escriba aqui un mensaje a los invitados..." id="eventMessage" name="mensaje_evento" style="width: 98%;"></textarea>
                            <span id="eventMenssage_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <input type="hidden" id="estado_evento" name="estado_evento" value="Activo">

                    <div class="botones">
                        <input type="submit" value="CONFIRMAR" id="submit" disabled>
                        <a href="{{ url('ModuloEventos') }}">CANCELAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/Eventos/validateCreateEvent.js') }}"></script>
</body>
</html>