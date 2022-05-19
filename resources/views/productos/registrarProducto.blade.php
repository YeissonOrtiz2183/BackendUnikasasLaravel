<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/productosCss/registrarProducto.css')}}">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <title>UNIKASAS</title>
</head>
<body>
    <h1>REGISTRAR PRODUCTO</h1>
    <div class="Matriz">
        <section>
            <div class="imagenSection">
                <h2>IMAGEN</h2>
                <p><img  class="img"src="/Img-Productos\House1.jpg"></p>
                <div class="icons">
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-left" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="15 6 9 12 15 18" />
                    </svg></a>
                    <a href=""><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <polyline points="9 6 15 12 9 18" />
                    </svg></a>
                    
                    <a href=""><svg class="plus"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg></a>
                </div>
            </div>
        </section>

        <aside>
            <form action="{{url('/productos')}}"  method="post" enctype="multipart/form-data"  id="formulary">
                @csrf
            
                <div class="formL">
                    <label class="labes">Nombre del producto:</label>
                    <input type="text" name="nombre_producto" id="inputNombreProducto">
                   
                </div>
                <span id="errorNombreProducto" class="spans"></span>
                <div class="formL">
                    <label class="labes">Descripcion:</label>
                    <input id="inputDescripcionProducto" name="descripcion_Producto" class="descrip" type="text" placeholder="Ingrese aqui la descripcion del producto">
                    
                </div>
                <span id="errorDescripcionProducto" class="spans"></span>

                <div class="formL">
                <label class="labes">Precio:</label>
                <input id="inputPrecioProducto" name="precio_producto" class="inputPrice"type="text" placeholder="Ingrese aqui el precio del producto">
               
                </div>
                <span id="errorPrecioProducto" class="spans"></span>
            
                <div class="saveCancel">
                    <div class="divSave">
                       <!--  <a class="save" id="save" href="#">Registrar</a>-->
                       <input type="submit" value="Registrar">
                    </div>

                    <div class="divCancel">
                        <!--<a class="cancel"href="#">Cancelar</a>-->
                    </div>
                </div>
                <!--Realizar barra de seleccionar estado-->
            </form>
        </aside>
    </div>
   
    

    <script src="{{asset('js/productos/validateRegistrarProducto')}}"></script>
    
</body>
</html>