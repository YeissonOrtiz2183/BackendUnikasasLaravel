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

Route::get('/', function () {
    return view('login.login');
});

Route::resource('eventos', EventoController::class)->middleware('auth')->middleware('eventos');
Route::get('/disponibilidad', [EventoController::class, 'disponibilidad'])->middleware('auth')->middleware('eventos');
Route::get('/eventos/{id}/cancel', [EventoController::class, 'cancel'])->middleware('auth')->middleware('eventos');
Route::get('/reporteEventos', [EventoController::class, 'reporteEventos'])->middleware('auth')->middleware('eventos');
Route::get('/exportPdfEventos', [EventoController::class, 'exportPdfEventos'])->middleware('auth')->middleware('eventos');


Route::resource('cotizaciones', CotizacionController::class)->middleware('auth')->middleware('cotizaciones');
Route::get('/exportPdfCotizaciones', [CotizacionController::class, 'exportPdfCotizaciones'])->middleware('auth')->middleware('cotizaciones');
Route::get('/cotizaciones/{id}/contestar', [CotizacionController::class, 'contestarCotizacion'])->middleware('auth')->middleware('cotizaciones');

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\LoginController;

Route::resource('proyectos', ProyectoController::class)->middleware('auth')->middleware('proyectos');
Route::get('proyectos/search/{estado}', [ProyectoController::class, 'index'])->middleware('auth')->middleware('proyectos');
Route::get('/reporteProyectos', [ProyectoController::class, 'reporteProyectos'])->middleware('auth')->middleware('proyectos');
Route::get('/exportPdfProyectos', [ProyectoController::class, 'exportPdfProyectos'])->middleware('auth')->middleware('proyectos');
Route::resource('actividades', ActividadController::class)->middleware('auth');

Route::resource('productos', ProductoController::class)->middleware('auth');
Route::resource('usuarios', UserController::class)->middleware('auth');
Route::get('/reporteUsuarios', [UserController::class, 'reporteUsuarios'])->middleware('auth');
Route::get('/exportPdfUsuarios', [UserController::class, 'exportPdfUsuarios'])->middleware('auth');

Route::resource('roles', RolController::class)->middleware('auth');
Route::resource('auditoria', AuditController::class)->middleware('auth');
Route::get('/reporteAuditoria', [AuditController::class, 'reporteAuditoria'])->middleware('auth');
Route::get('/exportPdfAuditoria', [AuditController::class, 'exportPdfAuditoria'])->middleware('auth');

Route::get('index', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);

?>
