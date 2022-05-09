<?php

use Illuminate\Support\Facades\Route;

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

use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ActividadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;

Route::resource('proyectos', ProyectoController::class);
Route::get('proyectos/search/{estado}', [ProyectoController::class, 'index']);
Route::resource('productos', ProductoController::class);
Route::resource('actividades', ActividadController::class);
Route::resource('usuarios', UserController::class);
Route::resource('roles', RolController::class);
