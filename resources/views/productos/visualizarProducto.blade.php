<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/productosCss/visualizarProducto.css')}}">
    <title>UNIKASAS</title>
</head>
<body>

    <section>
        <h1>VISUALIZAR PRODUCTO</h1>

        <div class="division">



            <div class="showImages">
                <img src="{{ asset('storage/' .$producto->foto_producto) }}" alt="" id="imageProduct">
            </div>
               <!-- <div class="images">
                    <div class="slideshow-container">
                        <div class="mySlides fade">
                            <div class="img">
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <img src="imgProductos/houseOne.jpg" style="width:300px; height: 150px;">
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            </div>
                          <div class="text">Caption Text</div>
                        </div>

                        <div class="mySlides fade">
                            <div class="img">
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <img src="imgProductos/houseTwo.jpg" style="width:300px; height: 150px;">
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            </div>
                          <div class="text">Caption Two</div>
                        </div>

                        <div class="mySlides fade">
                            <div class="img">
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <img src="imgProductos/houseThree.jpg" style="width:300px; height: 150px;">
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>
                            </div>
                          <div class="text">Caption Three</div>
                        </div>

                        <div class="buttons">

                        </div>

                        </div>
                        <br>

                        <div style="text-align:center">
                          <span class="dot" onclick="currentSlide(1)"></span>
                          <span class="dot" onclick="currentSlide(2)"></span>
                          <span class="dot" onclick="currentSlide(3)"></span>
                        </div>
                </div> -->
                <div class="dataProduct">
                    <p>id : {{$producto->id}}</p>
                    <p>Nombre del producto: {{$producto->nombre_producto}}<p>
                    <p>Descripcion:{{$producto->descripcion_producto}}</p>
                    <p>Precio:{{$producto->precio_producto}}</p>
                    <p>Estado del producto:{{$producto->estado_producto}}</p>
                </div>






                <!--<div class="botones">-->
                    <div class="Modificar">
                        <a href="{{url('productos/'.$producto->id.'/edit')}}">MODIFICAR</a>
                    </div>

                    <div class="Eliminar">
                        <a  href="#">ELIMINAR</a>
                    </div>
                <!--</div>-->


        </div>
    </section>

    <script src="carrusel.js"></script>

</body>
</html>
