<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/disponibilidad.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>Disponibilidad Eventos</title>
</head>
<body>
    <!--Area de trabajo-->
    <main class="workspace">
        <div class="top">
            <button class="button" onclick="history.back()"><span class="material-icons back">arrow_back</span></button>
            <h1 class="titleModule">Ver disponibilidad</h1>
        </div>
            <header classs="enunciado_calendario">
        
                <button class="boton">&#60;</button>
                <h2>Enero 2022</h2>
                <button class="boton">&#62;</button>
                
                <h3 class="info">Hoy:</h3>
                <button class="boton boton1">&nbsp;</button>
                <h3 class="info">Mas de tres dias:</h3>
                <button class="boton boton2">&nbsp;</button>
                <h3 class="info">Mas de 5 dias:</h3>
                <button class="boton boton3">&nbsp;</button>
            </header>
            <div class="seccion">
                <ol>
                    <li class="dia calendario_dias border">Domingo</li>
                    <li class="dia calendario_dias">Lunes</li>
                    <li class="dia calendario_dias">Martes</li>
                    <li class="dia calendario_dias">Miercoles</li>
                    <li class="dia calendario_dias">Jueves</li>
                    <li class="dia calendario_dias">Viernes</li>
                    <li class="dia calendario_dias borderuno">Sabado</li>
                </ol>
                <ol>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li class="inicio">1</li>
                    <li>2</li>
                    <li>3</li>
                    <li>4</li>
                    <li>5</li>
                    <li>6</li>
                    <li>7</li>
                    <li>8</li>
                    <li>9</li>
                    <li>10 <a href="eventosDia.html" class="evento_dia">10:00 - 11:30 am</a></li>
                    <li>11</li>
                    <li>12</li>
                    <li>13</li>
                    <li>14<a href="eventosDia.html" class="evento_dia evento_dia--color">03:00 - 03:30 pm</a></li>
                    <li>15</li>
                    <li>16</li>
                    <li>17</li>
                    <li>18</li>
                    <li>19</li>
                    <li>20</li>
                    <li>21</li>
                    <li>22</li>
                    <li>23</li>
                    <li>24</li>
                    <li class="borderdos">25<a href="eventosDia.html" class="evento_dia evento_dia--colordos">07:00 - 08:00 am</a></li>
                    <li>26</li>
                    <li>27</li>
                    <li>28</li>
                    <li>29</li>
                    <li>30</li>
                    <li class="bordertres">31</li>
                </ol>
            </div>
            
    </main>
</body>
</html>