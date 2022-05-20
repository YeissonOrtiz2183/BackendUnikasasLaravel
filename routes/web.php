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

/*Route::get('/', function () {
    return view('welcome');
});
*/
Route::resource('ModuloEventos', EventoController::class);

Route::get('/disponibilidad', function () {
    return view('ModuloEventos.disponibilidad');
});

Route::get('/reporteEventos', function () {
    return view('ModuloEventos.crearReporteEvent');
});

Route::get('/visualizarEventos', function () {
    return view('ModuloEventos.visualizarEvento');
});

// Route::get('/disponibilidad', EventoController::class);

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\AuditController;

Route::resource('proyectos', ProyectoController::class);
Route::get('proyectos/search/{estado}', [ProyectoController::class, 'index']);
Route::resource('productos', ProductoController::class);
/*Route::get('productos/search/{product}', [ProductoController::class, 'index']);*/
Route::resource('actividades', ActividadController::class);
Route::resource('usuarios', UserController::class);
Route::resource('roles', RolController::class);
Route::resource('auditoria', AuditController::class);

