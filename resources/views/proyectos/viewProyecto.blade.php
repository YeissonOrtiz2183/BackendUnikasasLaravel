<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/proyectos/viewProyecto.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Proyecto</title>
</head>
<body>
    <div class="main">
        <div class="top">
            <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            @foreach($proyecto as $proyecto)
            <h1>{{ $proyecto->nombre_proyecto }}</h1>
            @endforeach
        </div>
        <div class="contenedor">
            <aside>
                <div class="button FinishProject">
                    <a class="textButton" href="#">Finalizar</a>
                </div>
                <div class="button SuspenderProject">
                    <a class="textButton" href="#">Suspender</a>
                </div>
            </aside>
            <div class="proyecto">
                <div class="infoGeneral">
                    <label>Encargado: <span>{{ $proyecto->encargado_nombre }} {{ $proyecto->encargado_apellido }}</span></label>
                    <label>Cliente: <span>{{ $proyecto->cliente_nombre }} {{ $proyecto->cliente_apellido }}</span></label>
                    <label>Fecha inicio: <span>{{ $proyecto->fecha_inicio }}</span></label>
                    <label>Ubicación: <span>{{ $proyecto->ciudad_proyecto }} - {{ $proyecto->direccion_proyecto }}</span></label>
                    <label>Costo estimado: <span>${{ $proyecto->costo_estimado }}</span></label>
                    <label>Estado: <span>{{ $proyecto->estado_proyecto }}</span></label>
                    <label>Producto: <span>{{ $proyecto->nombre_producto }}</span></label>
                    <label>Fecha final estimada: <span>{{ $proyecto->fecha_fin }}</span></label>
                    <label>Costo final: <span>${{ $proyecto->costo_final }}</span></label>
                    <label>Fecha final: <span>{{ $proyecto->fecha_fin }}</span></label>
                    <a id="link1" href="{{ url('/proyectos/' .$proyecto->id. '/edit') }}"><span class="material-icons edit-1">edit</span></a>

                    <a id="link2" href="{{ url('/proyectos/' .$proyecto->id. '/edit') }}"><span class="material-icons edit-1">edit</span></a>
                </div>

                <div class="contenedorFases">
                    <div class="capaFase">

                        @foreach($etapas as $etapa)
                        <div class="fase">
                            <h2>{{ $etapa->nombre_etapa }}</h2>
                            @foreach($actividades as $actividad)
                                @if($actividad->etapa_id == $etapa->id)
                                    <div class="actividad">
                                        <h4>{{ $actividad->nombre_actividad }}</h4>
                                        <span>Fecha:  {{ $actividad->fecha_inicio }}</span>
                                        <span>Responsable: {{ $actividad->encargado_actividad }}</span>
                                        <div class="addDiv">
                                            <a href="{{ url('/actividades/' .$actividad->id) }}"><span class="material-icons view" value="{{ $myId = $actividad->id}}">visibility</span></a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                            <div class="addDiv">
                                <span class="material-icons add" value="{{ $etapa->id }}">add_circle</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- this -->


        <section class="modal hidden">
            <div class="modal__content modalSuspender">
                <div class="iconClose">
                    <span class="material-icons closeIcon">highlight_off</span>
                </div>
                <div class="modal__content--contenedor">
                    <h2>Motivo de la suspensión</h2>
                    <textarea name="" id="" cols="60" rows="10"></textarea>
                    <a href="../inicioProyecto/moduloInicioProyecto.html"><button class="save" type="button">Guardar</button></a>
                </div>
            </div>
        </section>

        <section class="modal hidden">
            <div class="modal__content editActivity">
                <div class="iconClose">
                    <span class="material-icons closeIcon">highlight_off</span>
                </div>
                <form action="{{ url('/actividades') }}" method="POST">
                    @csrf {{-- token de seguridad para el formulario  --}}
                    <div class="modal__content--contenedor">
                        <input id="titleActivity" name="nombre_actividad" type="text" placeholder="Nombre de la actividad">
                        <div class="infoActividad">
                            <div class="campo">
                                <label>Encargado:</label>
                                <input type="text" name="encargado_actividad">
                            </div>
                            <div class="campo">
                                <label>Objetivo:</label>
                                <textarea name="objetivo_actividad" id="" cols="40" rows="3"></textarea>
                            </div>
                            <div class="campo">
                                <label>Fecha inicio:</label>
                                <input type="date" name="fecha_inicio">
                            </div>
                            <div class="campo">
                                <label>Fecha fin:</label>
                                <input type="date" name="fecha_fin">
                            </div>
                            <div class="campo">
                                <label>Observaciones:</label>
                                <textarea name="observaciones_actividad" id="" cols="40" rows="4"></textarea>
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input type="text" name="estado_actividad">
                            </div>
                            <div class="botones">
                                <input class="save" type="submit" value="Crear actividad"></input>
                                <button class="save" type="button">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <section class="modal hidden">
            <div class="modal__content createActivity editActivity">
                <div class="iconClose">
                    <span class="material-icons closeIcon">highlight_off</span>
                </div>
                <div class="modal__content--contenedor">
                    <form action="{{ url('/actividades') }}" method="POST">
                        @csrf {{-- token de seguridad para el formulario  --}}
                        <input id="titleActivity" name="nombre_actividad" type="text" placeholder="Nombre de la actividad">
                        <div class="infoActividad">
                            <input type="text" value="" id="etapaId" name="etapa_id" style="display:none">
                            <div class="campo">
                                <label>Encargado:</label>
                                <input type="text" name="encargado_actividad">
                            </div>
                            <div class="campo">
                                <label>Objetivo:</label>
                                <textarea name="objetivo_actividad" id="" cols="40" rows="3"></textarea>
                            </div>
                            <div class="campo">
                                <label>Fecha inicio:</label>
                                <input type="date" name="fecha_inicio">
                            </div>
                            <div class="campo">
                                <label>Fecha fin:</label>
                                <input type="date" name="fecha_fin">
                            </div>
                            <div class="campo">
                                <label>Observaciones:</label>
                                <textarea name="observaciones_actividad" id="" cols="40" rows="4"></textarea>
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input type="text" name="estado_actividad">
                            </div>
                            <div class="botones">
                                <input class="save" type="submit" value="Crear actividad" id="save"></input>
                                <button class="save" type="button">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <section class="modal hidden">
            <div class="modal__content finalizarProyecto">
                <div class="iconClose">
                    <span class="material-icons closeIcon">highlight_off</span>
                </div>
                <div class="modal__content--contenedor">
                    <h2>Finalizar proyecto</h2>
                    <span>¿Desea finalizar el proyecto?</span>
                    <div class="botones">
                        <a href="../inicioProyecto/moduloInicioProyecto.html"><button class="save" type="button">Aceptar</button></a>
                        <button class="save" type="button">Cancelar</button>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="{{ asset('js/proyectos/viewProyecto.js') }}"></script>
</html>
