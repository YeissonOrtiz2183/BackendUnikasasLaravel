<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Models\Evento;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('ModuloEventos', EventoController::class);

Route::get('/disponibilidad', function () {
    return view('ModuloEventos.disponibilidad');
});

Route::get('/reporteEventos', function () {
    return view('ModuloEventos.crearReporteEvent');
});

Route::get('/ModuloEventos/visualizarEvento/{id}', function () {
    return view('ModuloEventos.visualizarEvento');
});