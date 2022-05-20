<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edggit checkout git 6c8364aa7e6dd2b174cae3c3162500a69c6a4280e">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UNIKASAS</title>
    <link rel="stylesheet" href="{{ asset('css/productosCss/productosInicio.css') }}">
    <link rel="stylesheet" href="{{asset('css/productosCss/modalP.css')}}">
    <link rel="stylesheet" href="{{asset('css/productoCss/publicar.css')}}">
    <link rel="stylesheet" href="{{asset('css/productosCss/mPublicarProducto.css')}}">
</head>
<body>
 <main>
        <h1>PRODUCTOS</h1>
        <div class="label">
            <form action="" >
            @csrf
            <label for=""></label>
            <input type="text" placeholder="Buscar producto" name="buscarpor" >
            <svg class="search"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="32" height="32" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="10" cy="10" r="7" />
                <line x1="21" y1="21" x2="15" y2="15" />
              </svg>


              <input type="submit" value="Enviar" class="bottonsearch">

              <div id="filtroBusqueda">
                <label for="" id="textSelectTipoCasas">Tipo de casa: </label>
                    <select name="tipo_producto" id="selectTipoCasas">

                        <option value="casa_de_uno_solo_agua">Casas de uno solo agua</option>
                        <option value="casa_en_dos_aguas">Casa en dos aguas</option>
                        <option value="casa_cuatro_aguas">Casa cuatro aguas</option>
                        <option value="chalet">Casa tipo chalet</option>
                        <option value="padoga">Casas tipo padoga</option>
                        <option value="bodega">Bodega</option>
                        <option value="aula">Aula</option>
                    </select>
                </div>

                <div id="filtroBusqueda">
                       <!-- <label for="" id="textMaterial">Tipo de material:</label>-->
                        <select name="material_producto" id="selectTipoMaterial">
                            <option value="plaqueta">Plaqueta</option>
                            <option value="bloquelon">Bloquelón</option>
                        </select>
                </div>

                <div id="filtroBusqueda">
                   <!-- <label for="" id="textPisos">Número de pisos:</label> -->
                    <select name="pisos_producto" id="selectPisos">
                        <option value="1_piso"> 1 piso</option>
                        <option value="2_pisos">2 pisos</option>
                    </select>
                </div>
            </form>
        </div>


        <div class="barra-Busqueda">


        </div>
        <!--modal-->
        <div class="modal-container">
            <div class="modal modal-close">
            <div class="modal-textos">
                <h1>¿Desea despublicar el producto?</h1>
            </div>
                <div class="modal-botones">
                    <button id="aceptar">ACEPTAR</button>
                    <div class="modal-botones">
                    <button id="cancelar">CANCELAR</button>
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
                <h1>¡El producto se despublico exitosamente!</h1>
            </div>
            <div class="botones-modal">
                <div class="centrar">
                <button id="confirmar">ACEPTAR</button>
            </div>
            </div>
            </div>
        </div>
    </div>

    <!--Modal despublicar-->

<!--Modal publicar producto-->

<div class="cont containerOne">

    <div class="modal">
        <h1>¿Desea publicar el producto?</h1>

        <div class="buttons">
            <button  class="button aceptar">ACEPTAR</button>
            <button  class="button cancelar">CANCELAR</button>
        </div>
    </div>
</div>


<div class="cont containertwo">

    <div class="modaltwo">
        <h1>!El producto se publico exitosamente!</h1>

        <div class="botonestwo">
            <button  class="buttontwo aceptartwo">ACEPTAR</button>
        </div>
    </div>
</div>







<!--Fin modal producto-->
        <div class="prueba">
            <div class="Botones">
                <div class="botonP">
                <a class="bot" id=""href="{{url('/productos/create')}}">Registrar Producto</a>
                </div>
                <div class="botonP">
                <a class="bot"href="#">CREAR REPORTE</a>
                </div>
            </div>
            </form>

            <div class="MatrizProductos">
                @foreach($productos as $producto)
                <div class="caja">
                    <h2>{{$producto->nombre_producto}}</h2> <!--Casa 1-->
                    <img src="{{ asset('storage/' .$producto->foto_producto) }}" alt="" />
                    <div class="iconos">
                        <a href="{{url('productos/'.$producto->id)}}"><svg  class="eye" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="2" />
                            <path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                        </svg></a>

                        <a href="">
                        <svg class="bot1 x"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />

                    </svg> </a>
                        <svg  id="carrito"class="mCarOne carShop"xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-shopping-cart" width="28" height="28" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="6" cy="19" r="2" />
                            <circle cx="17" cy="19" r="2" />
                            <path d="M17 17h-11v-14h-2" />
                            <path d="M6 5l14 1l-1 7h-13" />
                        </svg>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </main>
    <script src="{{asset('js/productos/modalP.js')}}"></script>
    <script src="modalpublicar/publicar.js"></script>
</body>
</html>
