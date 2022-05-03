<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Models\Evento;

use App\Http\Controllers\CotizacionController;
use App\Models\Cotizacion;

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

Route::get('/disponibilidad', [App\Http\Controllers\EventoController::class, 'disponibilidad'])->name('ModuloEventos.disponibilidad');

Route::get('/ModuloEventos/{id}/cancel', [App\Http\Controllers\EventoController::class, 'cancel'])->name('ModuloEventos.cancel');

Route::get('/reporteEventos', [App\Http\Controllers\EventoController::class, 'reporteEventos'])->name('ModuloEventos.reporte');


// rutas cotizaciones

Route::resource('cotizaciones', CotizacionController::class);