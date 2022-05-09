<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="moduloInicioProyecto.css">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <link rel="stylesheet" href="stylesCrearRol.css">
    <title>Usuarios Unikasas</title>
</head>

<body>
    <main class="workspace">
        <a href="{{ url('roles/' $rol->id) }}">
        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <line x1="5" y1="12" x2="19" y2="12" />
            <line x1="5" y1="12" x2="11" y2="18" />
            <line x1="5" y1="12" x2="11" y2="6" />
          </svg>
        </a>
        <h1 class="titleModule">Modificar rol</h1>
        <form class="formulario">
            <div class="campo">
                <label>Busque el usuario que desea modificar</label>
                <input type="text" name="searchBar" id="searchBar">
                <input type="submit" value="Buscar">
            </div>
        </form>
        <h3 class="info-rol">Información del rol</h3>
        <form class="formulario">
            <fieldset>
                <div class="campo">
                    <label>Nombre</label>
                    <input class="input-text" type="text">
                </div>
                <h3 class="privilegios">Privilegios:</h3>
            <div class="contenedor-campos">
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 1</label>
                </div>
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 2</label>
                </div>
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 3</label>
                </div>
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 4</label>
                </div>
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 5</label>
                </div>
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 6</label>
                </div>
                <div class= "campo">
                    <input class="check" type="checkbox">
                    <label>Privilegio 7</label>
                </div>
            </div>
            </fieldset>
        </form>
        <div class="confirmar">
        <a href="6inicioRoles.html" class="button-uno">Cancelar</a>
        <a href="6inicioRoles.html" class="button-dos">Confirmar</a>
        </div>
    </main>
</body>
