@extends('layouts.headerHome')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/home/inicio.css') }}">
    <title>Unikasas!</title>
</head>
<body>
    @section('content')
    <main class="workspace">
        <section class="container">
            @foreach($products as $product)
            <div class="producto">
                <img src="{{ asset('storage/'.$product->image) }}" alt="">
                <h2>{{ $product->nombre_producto }}</h2>
                <div class="data">
                    <p><b>Habitaciones:</b> {{ $product->habitaciones_producto }}</p>
                    <p><b>Tamaño:</b> {{ $product->tamaño_producto }}</p>
                </div>
                <a href="{{ url('producto/' .$product->id) }}">Ver más imagenes</a>
            </div>
            @endforeach
        </section>
    </main>
    @endsection
</body>
</html>
