<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Enviar correo de cancelación del evento</title>
    <style>
        h2, p, span{
            color: black;
        }
        a{
            padding: 5px 30px;
            color: #ffffff;
            font-size: 20px;
            border: none;
            border-radius: 10px;
            text-decoration: none;
            text-emphasis-color: #fff;
            background-color: #ffa500;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Cancelación del evento agendado</h2>
    <div>
        <p>Codial saludo:<p>
        <p>Se informa que el evento agendado ha dido cancelado por el siguiente motivo: <br>

        @if(isset($info['eventReason']))
            <span>{{ $info['eventReason']; }}.</span></p>
        @endif

        <p>Agradecemos su atención, quedamos atentos a cualquier inquietud...<p><br>
        
        <p>Para mas información sobre nuestros productos visite nuestro sitio web en el siguiente enlace:</p>
        <a href="www.youtube.com.co">Ir al sitio</a>
    </div>
</body>
</html>