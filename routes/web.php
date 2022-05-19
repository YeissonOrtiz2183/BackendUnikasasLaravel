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
use App\Http\Controllers\AuditController;
use App\Http\Controllers\LoginController;

Route::resource('proyectos', ProyectoController::class)->middleware('auth');
Route::get('proyectos/search/{estado}', [ProyectoController::class, 'index'])->middleware('auth');
Route::resource('productos', ProductoController::class)->middleware('auth');
Route::resource('actividades', ActividadController::class)->middleware('auth');
Route::resource('usuarios', UserController::class)->middleware('auth')->middleware('auth');
Route::resource('roles', RolController::class)->middleware('auth');
Route::resource('auditoria', AuditController::class)->middleware('auth');
Route::get('index', [LoginController::class, 'index']);
Route::post('login', [LoginController::class, 'authenticate']);
Route::post('logout', [LoginController::class, 'logout']);
