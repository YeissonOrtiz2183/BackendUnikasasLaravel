<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/login/login.css') }}">
    <title>UNIKASAS</title>
</head>
<body>
    <div class="loginBox">
        <svg onclick="history.back()" xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-x" width="36" height="36" viewBox="0 0 24 24" stroke-width="1.5" stroke="#000000" fill="none" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <circle cx="12" cy="12" r="9" />
            <path d="M10 10l4 4m0 -4l-4 4" />
          </svg>
        <img class="avatar"src="../inicio/img/Unikasas.png">
        <h1>LOGIN</h1>

        <form action="{{ url('login') }}" method="POST">
            @csrf {{-- token de seguridad para el formulario  --}}
            <!--Ingresar nombre de usuario-->
            <label for="Nombre de usuario">Usuario</label>
            <input type="text" placeholder="Ingrese usuario" name="email">

            <!--Ingresar Password-->
            <label for="Contraseña">Contraseña</label>
            <input type="password" placeholder="Ingrese contraseña" name="password">

            <button type="submit" id="loginButton">INGRESAR</button>

            <a href="#">Olvidé mi contraseña</a>
        </form>
    </div>
</body>
</html>
