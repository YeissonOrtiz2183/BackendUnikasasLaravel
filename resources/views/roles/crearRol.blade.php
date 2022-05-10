<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/roles/stylesCrearRol.css') }}">
    <title>Usuarios Unikasas</title>
</head>

<body>
    <main class="workspace">
        <a href="6inicioRoles.html">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
        <h1 class="titleModule">Crear rol</h1>
        <form class="formulario" id="createForm" method="post" action="{{ url('roles') }}">
            @csrf {{-- token de seguridad para el formulario  --}}
            <fieldset>
                <div class="campo">
                    <label>Nombre</label>
                    <input class="input-text" type="text" name="nombre_rol">
                </div>
                <h3 class="privilegios">Privilegios:</h3>
            <div class="contenedor-campos">
                @foreach($privilegios as $privilegio)
                <div class= "campo">
                    <input class="check" type="checkbox" name="privilegios[]" value="{{ $privilegio->id }}">
                    <label>{{ $privilegio->nombre_privilegio }}</label>
                </div>
                @endforeach
            </div>
            </fieldset>
        </form>
        <div class="confirmar">
        <a href="{{ url('roles') }}" class="button-uno">Cancelar</a>
        <button type="submit" class="button-dos" form="createForm">Confirmar</button>
        </div>
    </main>
</body>
