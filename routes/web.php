<?php

use App\Http\Controllers\EventoController;
use Illuminate\Support\Facades\Route;
use App\Models\Evento;
use App\Http\Middleware;
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

Route::resource('eventos', EventoController::class)->middleware('auth')->middleware('eventos');
Route::get('/disponibilidad', [App\Http\Controllers\EventoController::class, 'disponibilidad'])->middleware('auth')->middleware('eventos')->name('ModuloEventos.disponibilidad');
Route::get('/eventos/{id}/cancel', [App\Http\Controllers\EventoController::class, 'cancel'])->middleware('auth')->middleware('eventos')->name('ModuloEventos.cancel');
Route::get('/reporteEventos', [App\Http\Controllers\EventoController::class, 'reporteEventos'])->middleware('auth')->middleware('eventos')->name('ModuloEventos.reporte');
Route::get('/exportPdfEventos', [App\Http\Controllers\EventoController::class, 'exportPdfEventos'])->middleware('auth')->middleware('eventos')->name('ModuloEventos.exportPdfEventos');


Route::resource('cotizaciones', CotizacionController::class)->middleware('auth')->middleware('cotizaciones');
Route::get('/exportPdfCotizaciones', [App\Http\Controllers\CotizacionController::class, 'exportPdfCotizaciones'])->middleware('auth')->middleware('cotizaciones')->name('cotizaciones.exportPdfCotizaciones');
Route::get('/cotizaciones/{id}/contestar', [App\Http\Controllers\CotizacionController::class, 'contestarCotizacion'])->middleware('auth')->middleware('cotizaciones')->name('cotizaciones.contestarCotizacion');

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\notificaciones;

Route::resource('proyectos', ProyectoController::class)->middleware('auth')->middleware('proyectos');
Route::get('proyectos/search/{estado}', [ProyectoController::class, 'index'])->middleware('auth')->middleware('proyectos');
Route::resource('productos', ProductoController::class)->middleware('auth');
Route::resource('actividades', ActividadController::class)->middleware('auth');
Route::resource('usuarios', UserController::class)->middleware('auth')->middleware('usuarios');
Route::resource('roles', RolController::class)->middleware('auth')->middleware('roles');
Route::resource('auditoria', AuditController::class)->middleware('auth')->middleware('auditoria');
Route::get('index', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);
Route::get('notificaciones', [notificaciones::class, 'makeNotifications']);

?>
