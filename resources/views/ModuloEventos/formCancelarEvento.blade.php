<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancelar evento</title>
    <link rel="stylesheet" href="{{ asset('css/formularioCancelarEvento.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">
        <div class="top">
            <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            <h1 class="titleModule">Cancelar evento</h1>
        </div>
        <div class="formulario">
            <form action="{{ url('/ModuloEventos/'.$evento->id) }}" method="post">
                @csrf {{-- token de seguridad para el formulario  --}}

                {{ method_field('PATCH') }}
                <div class="contenedor-campos">
                    <div class="campo">
                        <label for="eventName" style="padding-left: 1%;">Nombre del evento:</label>
                        <div class="inputValidate">
                            <input type="text" readonly id="eventName" name="eventName" 
                            value="{{ isset($evento->nombre_evento)?$evento->nombre_evento:old('nombre_evento') }}" style="width: 98%;">
                            <span id="eventName_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="eventDate" style="padding-left: 14%;">Fecha: </label>
                        <div class="inputValidate">
                            <input type="date" class="date" id="eventDate" name="eventDate" style="width: 97%;">
                            <span id="eventDate_error_message" class="error_form"></span>
                        </div>
                         
                        <label for="eventTime">Hora:</label>
                        <div class="inputValidate">
                            <input type="time" class="date" id="eventTime" name="eventTime" style="width: 96%;">
                            <span id="eventTime_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <div class="campo">
                        <label for="eventProyect">Proyecto:</label>
                        <input type="text" id="eventProyect" name="eventProyect" readonly 
                        value="{{ isset($evento->proyecto_id)?$evento->proyecto_id:old('proyecto_id') }}" style="width: 94%;">
                    </div>

                    <div class="campo campoCompartido">
                        <label for="eventAssistant">Invitados:</label>
                        <textarea cols="120" rows="10" id="eventAssistant" name="eventAssistant" readonly style="width: 98%;">{{ isset($evento->invitados_evento)?$evento->invitados_evento:old('invitados_evento') }}</textarea>
                    </div>
                    
                    <div class="campo campoCompartido">
                        <label for="eventReason" style="padding-right: 5%;">Motivo:</label>
                        <div class="inputValidate">
                            <textarea cols="120" rows="10" placeholder="Escriba el motivo de la cancelacion del evento..." id="eventReason" name="eventReason" style="width: 98%;"></textarea>
                            <span id="eventReason_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <input type="hidden" id="estado_evento" name="estado_evento" value="Cancelado">

                    <div class="botones">
                        <input type="submit" value="CONFIRMAR" id="submit" disabled>
                        <a href="{{ url('ModuloEventos') }}">CANCELAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/validateCancelEvent.js')}}"></script>
</body>
</html>