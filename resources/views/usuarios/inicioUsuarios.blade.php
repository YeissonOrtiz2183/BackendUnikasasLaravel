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
    <link rel="stylesheet" href="{{ asset('css/usuarios/stylesInicioUsuarios.css') }}">
    <title>Usuarios Unikasas</title>
</head>
    <main class="workspace">
        <h1 class="titleModule">Usuarios</h1>
        <form class="searchForm" action="">
            <label for="itemSearch">Buscar usuario:</label>
            <input type="text" name="searchBar" id="searchBar">
            <a href="1.1buscarUsuarios.html">
            <input type="submit" value="Buscar">
            </a>
        </form>
        <div class= "lista-usuarios">
        <h3>Todos los usuarios</h3>
        </div>
        <div class= "uno">
        <div class="container">
            <aside>
                <div class="button">
                    <a class="buttonCreateProject" href="{{ url('usuarios/create') }}">Registrar usuario</a>
                </div>
                <div class="button">
                    <a class="buttonArchived" href="4modificarUsuario.html">Modificar usuario</a>
                </div>
                <div class="button">
                    <a class="buttonCreateReport" href="5reporteUsuarios.html">Crear reporte</a>
                </div>
            </aside>
            <div class="usuarios">
                @foreach($usuarios as $usuario)
                    <section>
                        <div class="contenedor">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-circle" width="40" height="40" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="12" r="9" />
                                <circle cx="12" cy="10" r="3" />
                                <path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855" />
                            </svg>
                            <div class="nombre-usuario">
                                <h2 class="info">{{ $usuario->primer_nombre }} {{ $usuario->segundo_nombre }} {{ $usuario->primer_apellido }} {{ $usuario->segundo_apellido }}</h2>
                            </div>
                            <a href="2verUsuario.html" class="visualizar">Ver información</a>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
        <a href="6inicioRoles.html">
        <aside class="roles">
        <div class="roles-icono foto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icono" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="18" r="2" />
                <circle cx="7" cy="6" r="2" />
                <circle cx="17" cy="6" r="2" />
                <path d="M7 8v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2 -2v-2" />
                <line x1="12" y1="12" x2="12" y2="16" />
              </svg>
        </div>
        <h3 class="rol">Roles</h3>
        </aside>
        </a>
        </div>
    </main>
</body>
</html>
