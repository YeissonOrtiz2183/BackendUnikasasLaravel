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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::resource('ModuloEventos', EventoController::class);
Route::get('/', function () {
    return view('welcome');
});

Route::resource('eventos', EventoController::class);

Route::get('/disponibilidad', [App\Http\Controllers\EventoController::class, 'disponibilidad'])->name('ModuloEventos.disponibilidad');

Route::get('/eventos/{id}/cancel', [App\Http\Controllers\EventoController::class, 'cancel'])->name('ModuloEventos.cancel');

Route::get('/reporteEventos', [App\Http\Controllers\EventoController::class, 'reporteEventos'])->name('ModuloEventos.reporte');

// Route::get('/disponibilidad', EventoController::class);

Route::get('/exportPdfEventos', [App\Http\Controllers\EventoController::class, 'exportPdfEventos'])->name('ModuloEventos.exportPdfEventos');

// rutas cotizaciones

Route::resource('cotizaciones', CotizacionController::class);

Route::get('/exportPdfCotizaciones', [App\Http\Controllers\CotizacionController::class, 'exportPdfCotizaciones'])->name('cotizaciones.exportPdfCotizaciones');

Route::get('/cotizaciones/{id}/contestar', [App\Http\Controllers\CotizacionController::class, 'contestarCotizacion'])->name('cotizaciones.contestarCotizacion');
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\LoginController;

Route::resource('proyectos', ProyectoController::class);
Route::get('proyectos/search/{estado}', [ProyectoController::class, 'index']);
Route::resource('productos', ProductoController::class);
/*Route::get('productos/search/{product}', [ProductoController::class, 'index']);*/
Route::resource('actividades', ActividadController::class);
Route::resource('usuarios', UserController::class);
Route::resource('roles', RolController::class);
Route::resource('auditoria', AuditController::class);

Route::get('index', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'authenticate']);
