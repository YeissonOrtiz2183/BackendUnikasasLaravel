<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/layout/styles.css') }}">
    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
    <title>Proyectos Unikasas</title>
</head>
<body>
    <header class="header">
        <nav class="header__navBar">
            <div class="header__navBar__iconsleft">
                <span class="material-icons md-200" id="menu">menu</span>
                <span class="material-icons md-200" id="userIcon">person</span>
                <h1 class="header__navBar__iconsleft__userName">Yeisson Estiven Ortiz Torres</h1>
            </div>
            <div class="header__navBar__iconsRight">
                <span class="material-icons md-200 logout">logout</span>
                <span class="material-icons md-200 notifications">notifications</span>
                <span class="material-icons md-200 calendar">calendar_today</span>
                <span class="material-icons md-200 help" >help_outline</span>
            </div>
        </nav>
    </header>
    <div class="divPrueba">
        <div class="navLateral">
            <ul class="navLateral__sidebar">
                <a href="{{ url('cotizaciones') }}"><span class="material-icons md-100 cotizaciones">assignment</span></a>
                <li><a href="#">Cotizaciones</a></li>
                <a href="#"><span class="material-icons md-100 products">shopping_cart</span></a>
                <li><a href="#">Productos</a></li>
                <a href="{{ url('proyectos/search/activo') }}"><span class="material-icons md-100 projects">folder_open</span></a>
                <li><a href="{{ url('proyectos/search/activo') }}">Proyectos</a></li>
                <a href="{{ url('eventos') }}"><span class="material-icons md-100 events">event</span></a>
                <li><a href="#">Eventos</a></li>
                <a href="{{ url('usuarios') }}"><span class="material-icons md-100 users">person</span></a>
                <li><a href="{{ url('usuarios') }}">Usuarios</a></li>
                <a href="{{ url('auditoria') }}"><span class="material-icons md-100 auditoria">verified_user</span></a>
                <li><a href="#">Auditoria</a></li>
            </ul>
        </div>

        <section class="modal hidden">
            <div class="modalLogout">
                <a href="../../ModuloInicio/inicio/inicio.html">Cerrar sesión</a>
            </div>
        </section>
        <section class="modal hidden">
            <div class="modalNotifications">
                <ul>
                    <li>Hay 20 cotizaciones nuevas que necesitan una respuesta</li>
                    <li>2 proyectos han avanzado en la etapa de etapa</li>
                    <li>Hoy tienes 3 reuniones planeadas</li>
                </ul>
            </div>
        </section>
        <section class="modal hidden">

        </section>

        <section class="modal hidden">
            <div class="modalHelp">
                <h2>Instrucciones de uso:</h2>
                <figure>
                    <img src="https://cutt.ly/bIB5a2e" alt="">
                </figure>
            </div>
        </section>
        @yield('content')
    </div>
</body>
<script src="{{ asset('js/layout/app.js') }}"></script>
</html>
