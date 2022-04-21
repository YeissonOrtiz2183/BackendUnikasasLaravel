<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CrearProyecto</title>
    <link rel="stylesheet" href="{{ asset('css/proyectos/crearProyecto.css') }}">
    <link rel="stylesheet" href="{{https://fonts.googleapis.com/css?family=Roboto}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
    <div class="main">
        <h1 class="titleModule">Crear proyecto</h1>
        <div class="formulario">
            <form action="{{ route('proyectos') }}" method="post" id="myForm">
                <div class="contenedor-campos">
                    <h2><strong>Información general del proyecto</strong></h2>
                    <div class="campo">
                        <label>Nombre del proyecto:</label>
                        <div class="inputValidate">
                            <input type="text" placeholder="Nombre del proyecto..." name="projectName" id="projectName">
                            <span id="projectName_error_message" class="error_form"></span>
                        </div>
                    </div>
                    <div class="campo">
                        <label>Encargado del proyecto:</label>
                        <div class="inputValidate">
                            <select class="campomedio bigField" name="projectDirector" id="projectDirector">
                                <option value="null" selected disabled hidden>Selecciona un encargado para el proyecto</option>
                                <option value="1">Opcion1</option>
                            </select>
                            <span id="projectDirector_error_message" class="error_form"></span>
                        </div>
                    </div>

                    <div class="campo">
                        <label>Costo estimado:</label>
                        <div class="inputValidate">
                            <input type="number" class="campomedio" name="cost" id="projectCost">
                            <span id="projectCost_error_message" class="error_form"></span>
                        </div>
                    </div>
                    
                    <div class="campo campoDoble">
                            <label>Ciudad:</label>
                            <div class="inputValidate">
                                <input type="text" class="city" name="city" id="projectCity">
                                <span id="projectCity_error_message" class="error_form"></span>
                            </div>
                        
                            <label class="ciudad">Dirección:</label>
                            <div class="inputValidate">
                                <input type="text" class="address" name="address" id="projectAddress">
                                <span id="projectAddress_error_message" class="error_form"></span>
                            </div>
                            
                    </div>

                    <div class="campo campoDoble">
                        <label>Fecha inicio del proyecto: </label>
                        <div class="inputValidate">
                            <input type="date" class="date" name="startDate" id="startDate">
                            <span class="projectDate_error_message" class="error_form"></span>
                        </div>
                        
                        <label>Fecha fin del proyecto: </label>
                        <div class="inputValidate">
                            <input type="date" class="date" name="finalDate" id="finalDate">
                            <span class="projectDate_error_message" class="error_form"></span>
                        </div>
                    </div>
                    
                    <h2><strong>Información del producto</strong></h2>

                    <div class="campo campoProducto">
                        <label>Producto:</label>
                        <div class="inputValidate">
                            <select type="text" class="product" list="producto" name="product" id="projectProduct">
                                <option value="null" selected disabled hidden>Selecciona el producto del proyecto...</option>
                                <option value="1">Opcion1</option>
                            </select>
                            <span id="projectProduct_error_message" class="error_form"></span>
                        </div>

                        <label>Valor producto:</label>
                        <input type="number" class="priceProduct" readonly>
                    </div>

                    <div class="campo campoCompartido">
                        <label>Descripción:</label>
                        <textarea cols="120" rows="10" readonly></textarea>
                    </div>
                    
                    <div class="campo campoCompartido image">
                        <label>Imagen del producto:</label>
                        <img src="https://imgr.search.brave.com/6hWsit4UByxIN47ceHadtGHg6oYR2LiFCoDCxyeUcBw/fit/1200/719/ce/1/aHR0cHM6Ly93d3cu/c29tb3NtYW1hcy5j/b20uYXIvd3AtY29u/dGVudC91cGxvYWRz/LzIwMTcvMDcvQyVD/MyVCM21vLWN1cmFy/LXVuYS1jYXNhLWVu/ZmVybWEuanBn">
                    </div>

                    <h2><strong>Información del cliente</strong></h2>

                    <div class="campo">
                        <label style="padding-right: 1.5%;">Cliente:</label>
                        <div class="inputValidate">
                            <div class="input">
                                <input type="text" list="cliente" id="projectClient" name="projectClient" style="width: 98%;">
                                <datalist id="cliente">
                                    <option value="1">Client 1</option>
                                    <option value="2">Client 2</option>
                                </datalist>
                            </div>
                            <span id="projectClient_error_message" class="error_form"></span>
                        </div>
                    </div>
                    
                    <div class="campo cliente">
                        <label>Primer nombre cliente:</label>
                        <input type="text" readonly>
                        <label>Segundo nombre cliente:</label>
                        <input type="text" readonly>
                    </div>

                    <div class="campo cliente">
                        <label>Primer apellido cliente:</label>
                        <input type="text" readonly>
                        <label>Segundo apellido cliente</label>
                        <input type="text" readonly>
                    </div>

                    <div class="botones">
                        <input class="confirm" href="{{ 'proyectos' }}" type="submit" value="CONFIRMAR" disabled id="submit"></input>
                        <a class="cancel" href="../inicioProyecto/moduloInicioProyecto.html">CANCELAR</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="validate.js"></script>
</body>
</html>