<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Eventos/cearReporteEventos.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Crear reporte de Eventos</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <div class="top">
            <button onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            <h1 class="titleModule">Crear reporte de eventos</h1>
        </div>
        <form class="searchForm" action="">
            @csrf
            <label class="search_parametros" for="itemSearch">Filtrar por / </label>
            <label class="search_parametros" for="itemSearch">N° eventos:</label>
            <select class="input-text" type="text" name="nombre" id="searchBar">
                <option value="opcion1" select>Todos</option>
                <option value="opcion1" select>1</option>
                <option value="opcion2" select>2</option>
                <option value="opcion3"select>3</option>
            </select>

            <label class="search_parametros" for="fechaInicial">Fecha:</label>
            <input type="date" id="fechaInicial" name="fechaInicial">Hasta:
            <input type="date" id="fechaFinal" name="fechaFinal">
              
        </form>
        <div class="container">
                <form class="formulario">
                    @csrf
                    <h2 class="formulario__titulo">Seleccionar campos</h2>
                    <div class="contenedor-campos contenedor-campos2">
                        <div class="campo">   
                            <label>Nombre:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Fecha:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Hora de inicio:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Hora de finalización:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Proyecto:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Notificación:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Invitados:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Lugar:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Asunto:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Mensaje:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Estado:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label>Seleccionar Todos:</label>
                            <input class="checkbox" type="checkbox">
                        </div>
                        <div class="campo">
                            <label><i>Generar en:</i></label>
                        </div>
                        <div class="campo">
                            <label for="formato">Pdf:</label>
                            <input class="checkbox" type="checkbox" name="formato" value="formato">
                        </div>
                        <div class="campo">
                            <label for="formato">Excel:</label>
                            <input class="checkbox" type="checkbox" name="formato" value="formato">
                        </div>
                    </div>

                    <div class="botones">
                        <input class="generar" type="submit" value="Generar">
                        <input class="cancelar" type="submit" value="Cancelar" src="./moduloEventosInicio.html">
                    </div>
                </form>
        </div>
        <div class="previsualizacion">
            <h2 class="titulo_previsualizacion">Previsualización</h2>
            <a href="#" class="icono_dowload"><svg width="35" height="35" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M38.9778 4.95556L35.8889 1.22222C35.2889 0.466667 34.3778 0 33.3333 0H6.66667C5.62222 0 4.71111 0.466667 4.08889 1.22222L1.02222 4.95556C0.377778 5.71111 0 6.71111 0 7.77778V35.5556C0 38 2 40 4.44444 40H35.5556C38 40 40 38 40 35.5556V7.77778C40 6.71111 39.6222 5.71111 38.9778 4.95556ZM20 32.2222L7.77778 20H15.5556V15.5556H24.4444V20H32.2222L20 32.2222ZM4.71111 4.44444L6.51111 2.22222H33.1778L35.2667 4.44444H4.71111Z" fill="black"/>
                </svg></a>  
        </div>
        <div class="contenedor__imagen">
            <div class="container">
          
                <table>
                    <tr><th>Id </th>
                        <th>Nombre </th>
                        <th>Fecha </th>
                        <th>Hora de inicio </th>
                        <th>Hora de finalización </th>
                        <th>Proyecto </th>
                        <th>Notificación </th>
                        <th>Invitados </th>
                        <th>Lugar </th>
                        <th>Asunto </th>
                        <th>Mensaje </th>
                        <th>Estado </th>
                    </tr>

                    {{-- @foreach ($envetos as $evento) --}}
    
                    <tr><td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td></tr>
                    
                    {{-- @endforeach --}}
                </table>
            </div> 
        </div>       
    </main>
</body>
</html>