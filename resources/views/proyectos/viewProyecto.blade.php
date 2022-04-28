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
            <h1>{{ $proyecto->nombre_proyecto }}</h1>
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
                    <label>Encargado: <span>Fabio Nelson Fierro Cubillos</span></label>
                    <label>Cliente: <span>Yeisson Estiven Ortiz Torres</span></label>
                    <label>Fecha inicio: <span>{{ $proyecto->fecha_inicio }}</span></label>
                    <label>Ubicación: <span>{{ $proyecto->ciudad_proyecto }} - {{ $proyecto->direccion_proyecto }}</span></label>
                    <label>Costo estimado: <span>${{ $proyecto->costo_estimado }}</span></label>
                    <label>Estado: <span>{{ $proyecto->estado_proyecto }}</span></label>
                    <label>Producto: <span>{{ $proyecto->producto_id }}</span></label>
                    <label>Fecha final estimada: <span>{{ $proyecto->fecha_fin }}</span></label>
                    <label>Costo final: <span>${{ $proyecto->costo_final }}</span></label>
                    <label>Fecha final: <span>{{ $proyecto->fecha_fin }}</span></label>
                    <a id="link1" href="../editarProyecto/index.html"><span class="material-icons edit-1">edit</span></a>
                    
                    <a id="link2" href="../editarProyecto/index.html"><span class="material-icons edit-1">edit</span></a>
                </div>
                <form action="{{ url('/proyectoetapa') }}" method="post">
                    <input type="submit" value="Crear etapas">
                </form>
                <div class="contenedorFases">
                    <div class="capaFase">
                        @foreach($etapas as $etapa)
                            <div class="fase">
                                <h2>{{ $etapa->nombre_etapa }}</h2>
                                @foreach($actividades as $actividad)
                                <div class="actividad">
                                    <h4>{{ $actividad->nombre_actividad }}</h4>
                                    <span>Fecha:  22/10/2021</span>
                                    <span>Responsable: Nelson Fierro</span>
                                    <div class="addDiv">
                                        <span class="material-icons view">visibility</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <section class="modal hidden">
            <div class="modal__content modalActivity">
                <div class="iconClose">
                    <span class="material-icons closeIcon">highlight_off</span>
                </div>
                <div class="modal__content--contenedor">
                    <h2>Creación del contrato</h2>
                    <div class="infoActividad">
                        <div class="data1">
                            <b>Encargado:</b>
                            <b>Sebastian Fierro Cubillos</b>
                            <b>Objetivo:</b>
                            <b>Crear los planos hidraulicos para el proyecto <br>'Casa rural 40m2' del cliente 'Maria Juliana Gonzales Tapias'</b>
                            <b>Fecha inicio:</b>
                            <b>22/10/2021</b>
                            <b>Fecha fin:</b>
                            <b>24/10/2021</b>
                            <b>Observaciones:</b>
                            <b></b>
                            <b>Estado:</b>
                            <b>En ejecución</b>
                        </div>
                    </div>
                    <div class="botones">
                        <button class="save" type="button">Completar actividad</button>
                        <a><span class="material-icons edit">edit</span></a>
                    </div>
                </div>
            </div>
        </section>

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
                <div class="modal__content--contenedor">
                    <input id="titleActivity" type="text" placeholder="Nombre de la actividad">
        
                    <div class="infoActividad">
                        <form action="">
                            <div class="campo">
                                <label>Encargado:</label>
                                <input type="text">
                            </div>
                            <div class="campo">
                                <label>Objetivo:</label>
                                <textarea name="" id="" cols="40" rows="3"></textarea>
                            </div>
                            <div class="campo">
                                <label>Fecha inicio:</label>
                                <input type="date">
                            </div>
                            <div class="campo">
                                <label>Fecha fin:</label>
                                <input type="date">
                            </div>
                            <div class="campo">
                                <label>Observaciones:</label>
                                <textarea name="" id="" cols="40" rows="4"></textarea>
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input type="text">
                            </div>
                            <div class="botones">
                                <button class="save" type="button">Guardar cambios</button>
                                <button class="save" type="button">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <section class="modal hidden">
            <div class="modal__content createActivity editActivity">
                <div class="iconClose">
                    <span class="material-icons closeIcon">highlight_off</span>
                </div>
                <div class="modal__content--contenedor">
                    <input id="titleActivity" type="text" placeholder="Nombre de la actividad">
        
                    <div class="infoActividad">
                        <form action="">
                            <div class="campo">
                                <label>Encargado:</label>
                                <input type="text">
                            </div>
                            <div class="campo">
                                <label>Objetivo:</label>
                                <textarea name="" id="" cols="40" rows="3"></textarea>
                            </div>
                            <div class="campo">
                                <label>Fecha inicio:</label>
                                <input type="date">
                            </div>
                            <div class="campo">
                                <label>Fecha fin:</label>
                                <input type="date">
                            </div>
                            <div class="campo">
                                <label>Observaciones:</label>
                                <textarea name="" id="" cols="40" rows="4"></textarea>
                            </div>
                            <div class="campo">
                                <label>Estado:</label>
                                <input type="text">
                            </div>
                            <div class="botones">
                                <button class="save" type="button">Guardar cambios</button>
                                <button class="save" type="button">Cancelar</button>
                            </div>
                        </form>
                    </div>
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