<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>UNIKASAS</title>
    <link rel="stylesheet" href="{{asset('css/productosCss/modificarProducto.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>
<body>
<main>
    <div class="modal-container">
        <div class="modal modal-close">
        <div class="modal-textos">
            <h1>¿Desea modificar el producto?</h1>
        </div>
            <div class="modal-botones">
                <button id="aceptar" >Aceptar</button>
                <div class="modal-botones">
                <button id="cancelar">Cancelar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="segunda-modal">
        <div class="contenedor-modales">
        <div class="modal-salir">
            <div class="irse">
                <button id="irse">X</button>
            </div>
        <div class="texto-Modal">
            <h1>SE HA REGISTRADO EL PRODUCTO</h1>
        </div>
        <div class="botones-modal">
            <button id="confirmar">Aceptar</button>
        </div>
        </div>
    </div>
</div>



    <h1>REGISTRAR PRODUCTO</h1>
    <form action="{{url('/productos')}}" id="formulary" method="post" enctype="multipart/form-data">
        @csrf

    <div class="Matriz">

        <section>

            <div class="imagenSection">
                <h2>IMAGEN</h2>
                <p style="text-align:center;"><img class="img" id="blah" src=""></p>
                <div class="icons">
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="15 6 9 12 15 18" />
                    </svg></a>
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="9 6 15 12 9 18" />
                    </svg></a>
                    <input type="file" class="inputfile" id="file" onchange="readURL(this);" />
                    <label for="file"><svg class="plus"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg></label>
                </div>
            </div>
        </section>

        <aside>
            <div class="formL inputdata">
                <label class="labes">Nombre del producto:</label>
                <input id="inputNombreProducto" type="text" name="nombre_producto" >
            </div>
            <span id="errorNombreProducto" class="spans"></span>
            <div class="formL inputdata">
                <label class="labes">Descripción:</label>
                <input id="inputDescripcionProducto" class="descrip" name="descripcion_producto"type="text" placeholder="Ingrese aqui la descripción del producto">
            </div>
            <span id="errorDescripcionProducto" class="spans"></span>
            <div class="formL inputdata">
            <label class="labes">Precio:</label>
            <input id="inputPrecioProducto" class="inputPrice" type="number" placeholder="Ingrese aqui el precio del producto" name="precio_producto">
            </div>
            <span id="errorPrecioProducto" class="spans"></span>
            <div id="filtroBusqueda" class="inputdata">
            <label for="" id="textSelectTipoCasas">Tipo de casa: </label>
                <select name="tipo_producto" id="selectTipoCasas">
                    <option value="Casa de uno solo_agua">Casas de uno solo agua</option>
                    <option value="Casa en dos aguas">Casa en dos aguas</option>
                    <option value="Casa cuatro aguas">Casa cuatro aguas</option>
                    <option value="Chalet">Casa tipo chalet</option>
                    <option value="Padoga">Casas tipo padoga</option>
                    <option value="Bodega">Bodega</option>
                    <option value="Aula">Aula</option>
                </select>
            </div>
            <div id="filtroBusqueda" class="inputdata">
                    <label for="" id="textMaterial">Tipo de material:</label>
                    <select name="material_producto" id="selectTipoMaterial">
                        <option value="Plaqueta">Plaqueta</option>
                        <option value="Bloquelon">Bloquelón</option>
                    </select>
            </div>
            <div id="filtroBusqueda" class="inputdata">
                <label for="" id="textPisos">Número de pisos:</label>
                <select name="pisos_producto" id="selectPisos">
                    <option value="1 piso"> 1 piso</option>
                    <option value="2 pisos">2 pisos</option>
                </select>
            </div>
            <div class="formL inputdata">
                <label class="labes" for="itemSearch">Estado actual:</label>
                <select class="input-text" type="text" name="estado_producto" id="searchBar">
                    <option value="Activo">Activo</option>
                    <option value="Publicado">Publicado</option>
                    <option value="Despublicado">Despublicado</option>
                </select>
            </div>
            <div class="saveCancel">
                <div class="divSave">
                    <input type="submit" value="Registrar" class="divSave" id="enviar">
                </div>
                <div class="divCancel">
                    <a class="cancel" href="{{ url('productos') }}">Cancelar</a>
                </div>
            </div>
        </aside>
        </form>
    </div>
    </form>
<main>
    <script src="{{asset('js/productos/validateProductos.js')}}"></script>
    <script src="../modificarProducto2/js/modificarProducto.js"></script>
    <script src="{{ asset('js/productos/addImages.js') }}"></script>
</body>
</html>
