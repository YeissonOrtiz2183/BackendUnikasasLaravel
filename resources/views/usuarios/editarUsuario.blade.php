@extends('layouts.layout')
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
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesVerUsuario.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesRegistrarUsuario.css') }}">
    <title>Usuarios Unikasas</title>
</head>

<body>
    @section('content')
    <main class="workspace">
        <a onclick="history.back()">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
        <h1 class="titleModule">Modificar perfil</h1>
        <form class="formulario" action="{{ url('/usuarios/' .$usuario->id) }}" method="POST" id="editForm">
            @csrf {{-- token de seguridad para el formulario  --}}
            {{ method_field('PATCH') }}
            <fieldset>
                <div class="contenedor-campos">
                @if($isMe)
                <div class="campo">
                    <label>Primer nombre</label>
                    <input class="input-text" type="text"  name="primer_nombre" value="{{ $usuario->primer_nombre }}">
                </div>
                <div class="campo">
                    <label>Segundo nombre</label>
                    <input class="input-text" type="text" name="segundo_nombre" value="{{ $usuario->segundo_nombre }}">
                </div>
                <div class="campo">
                    <label>Primer apellido</label>
                    <input class="input-text" type="text" name="primer_apellido" value="{{ $usuario->primer_apellido }}">
                </div>
                <div class="campo">
                    <label>Segundo apellido</label>
                    <input class="input-text" type="text" name="segundo_apellido" value="{{ $usuario->segundo_apellido }}">
                </div>
                <div class="campo">
                    <label>Tipo de documento</label>
                    <select name="tipo_documento">
                        <option value="{{ $usuario->tipo_documento }}">{{ $usuario->tipo_documento }}</option>
                        <option value="CC">Cedula de ciudadanía</option>
                        <option value="CE">Cedula de extranjería</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Numero de documento</label>
                    <input class="input-text" type="number" name="numero_documento" value="{{ $usuario->numero_documento }}">
                </div>
                <div class="campo">
                    <label>Correo electrónico</label>
                    <input class="input-text" type="text" name="email" value="{{ $usuario->email }}">
                </div>
                <div class="campo">
                    <label>Contraseña</label>
                    <input class="input-text" type="password" name="password" value="{{ $usuario->password }}">
                </div>
                <div class="campo">
                    <label>Número de teléfono</label>
                    <input class="input-text" type="text" name="telefono_usuario" value="{{ $usuario->telefono_usuario }}">
                </div>
                @endif
                @if($isUserAdmin)
                <div class="campo">
                    <label>Roles</label>
                    <select name="rol_id">
                        @foreach ($rol as $myrol)
                            <option value="{{ $myrol->id }}">{{ $myrol->nombre_rol }}</option>
                        @endforeach
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->nombre_rol }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="campo">
                    <label>Estado</label>
                    <select name="estado_usuario">
                        <option value="{{ $usuario->estado_usuario }}">{{ $usuario->estado_usuario }}</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                @endif
            </fieldset>
        </form>
        <div class="confirmar">
            <button type="submit" form="editForm" class="button-dos">Guardar</button>
            <a onclick="history.back()" class="button-uno">Cancelar</a>
        </div>
    </main>
    @endsection
</body>
