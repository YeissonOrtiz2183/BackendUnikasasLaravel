@extends('layouts.layout')

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
@section('content')
<main>
<h1>MODIFICAR PRODUCTO</h1>
<form action="{{url('/productos/'.$producto->id)}}" id="formulary" method="post" enctype="multipart/form-data">

    @csrf
    {{method_field('PATCH')}}
    <div class="Matriz">


        <section>
            <div class="imagenSection">
                <h2>IMAGEN</h2>
                <div class="slideshow-container">

                  <!-- Full-width images with number and caption text -->
                  @foreach($images as $image)
                  <div class="mySlides fade">
                    <img src="{{ asset('storage/' .$image->path) }}" id="blah" class="image img">
                  </div>
                  @endforeach

                  <!-- Next and previous buttons -->
                  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                  <a class="next" onclick="plusSlides(1)">&#10095;</a>
                </div>
                <br>

                <!-- The dots/circles -->
                <div style="text-align:center">
                    @foreach($images as $image)
                    <span class="dot" onclick="currentSlide({{ $image->id }})"></span>
                    @endforeach
                </div>

                <div class="inputFiles">
                    <input required type="file" class="inputfile" id="file" name="images[]" onchange="readURL(this);" />
                    <button>Eliminar imagen</button>
                </div>
            </div>
        </section>

        <aside>
            <div class="formL inputdata">
                    <label class="labes">Nombre del producto:</label>
                    <input id="inputNombreProducto" type="text" name="nombre_producto" value="{{$producto->nombre_producto}}">
                </div>
                <span id="errorNombreProducto" class="spans"></span>
                <div class="formL inputdata">
                    <label class="labes">Descripcion:</label>
                    <input id="inputDescripcionProducto" class="descrip" name="descripcion_producto"type="text"  value="{{$producto->descripcion_producto}}">
                </div>
                <span id="errorDescripcionProducto" class="spans"></span>

                <div class="formL inputdata">
                <label class="labes">Precio:</label>
                <input id="inputPrecioProducto" class="inputPrice"type="text"  name="precio_producto" value="{{$producto->precio_producto}}">
                </div>
                <span id="errorPrecioProducto" class="spans"></span>

                <div id="filtroBusqueda" class="inputdata">
                <label for="" id="textSelectTipoCasas">Tipo de casa: </label>
                    <select name="tipo_producto" id="selectTipoCasas">
                        <option value="Casa de uno solo agua">Casas de uno solo agua</option>
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
                        <option value="1 Piso"> 1 Piso</option>
                        <option value="2 Pisos">2 Pisos</option>
                    </select>
                </div>


                <div class="formL inputdata">
                    <label class="labes" for="itemSearch">Estado actual:</label>
                    <select class="input-text" type="text" name="estado_producto" id="searchBar">
                    <option value="Activo">Activo</opcion>
                    <option value="Publicado">Publicado</opcion>
                    </select>
                </div>

                <div class="saveCancel">
                    <div class="divSave">
                     <!--   <input type="submit" value="Modificar" class="divSave" id="enviar">  -->
                    <a class="save" id="save" href="#">Modificar</a>
                    </div>

                    <div class="divCancel">
                        <a class="cancel"href="{{url('productos/'. $producto->id)}}">Cancelar</a>
                    </div>
                </div>
                <!--Realizar barra de seleccionar estado-->

        </aside>

        <div class="modal-container">
        <div class="modal modal-close">
        <div class="modal-textos">
            <h1>¿Desea modificar el producto?</h1>
        </div>
            <div class="modal-botones">
              <!--  <button id="aceptar" >Aceptar</button> -->
              <input type="submit" value="Aceptar" id="guardar">
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
            <h1>SE HA MODIFICADO EL PRODUCTO</h1>
        </div>
        <div class="botones-modal">
            <button id="confirmar">Aceptar</button>
        </div>
        </div>
    </div>
    </form>
    <script src="{{asset('js/productos/modificarProducto.js')}}"></script>
    <script src="../modificarProducto2/js/modificarProducto.js"></script>
    <script src="{{ asset('js/productos/showImage.js') }}"></script>
</main>
@endsection
</body>
</html>
