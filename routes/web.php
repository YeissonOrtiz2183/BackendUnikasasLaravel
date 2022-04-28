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
use App\Http\Controllers\ProyectoEtapa;

Route::resource('proyectos', ProyectoController::class);
Route::resource('productos', ProductoController::class);
Route::resource('proyectoetapa', ProyectoEtapa::class);