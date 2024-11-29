<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VehiculoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
    Route::get('login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
    Route::post('doLogin', [App\Http\Controllers\LoginController::class, 'doLogin'])->name('doLogin');
    Route::post('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
    Route::group([ 'middleware'=>['redirectToLogin'/*, 'validarUsuario'*/]], function(){
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('/');
        Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('cargarVehiculo', [App\Http\Controllers\VehiculoController::class, 'cargarVehiculo'])->name('cargarVehiculo');
        Route::get('cargarRecepcionista/{id}', [App\Http\Controllers\VehiculoController::class, 'cargarRecepcionista'])->name('cargarRecepcionista');
        Route::get('cargarMecanico/{id}', [App\Http\Controllers\VehiculoController::class, 'cargarMecanico'])->name('cargarMecanico');
        Route::post('doCarga', [App\Http\Controllers\VehiculoController::class, 'doCarga'])->name('doCarga');
        Route::post('doRecepcion', [App\Http\Controllers\VehiculoController::class, 'doRecepcion'])->name('doRecepcion');
        Route::post('doMecanico', [App\Http\Controllers\VehiculoController::class, 'doMecanico'])->name('doMecanico');
        Route::get('listadosVehiculos', [App\Http\Controllers\VehiculoController::class, 'index'])->name('listadosVehiculos');
        Route::get('getVehiculos', [App\Http\Controllers\VehiculoController::class, 'getVehiculos'])->name('getVehiculos');
        Route::get('getModelo', [App\Http\Controllers\VehiculoController::class, 'getModelo'])->name('getModelo');
        Route::get('listadoModelos', [App\Http\Controllers\ModeloController::class, 'index'])->name('listadoModelos');
        Route::get('listadoMarcas', [App\Http\Controllers\MarcaController::class, 'index'])->name('listadoMarcas');
        Route::get('listadosUsuario', [App\Http\Controllers\PersonaController::class, 'index'])->name('listadosUsuario');
        Route::get('listadosCliente', [App\Http\Controllers\ClienteController::class, 'index'])->name('listadosCliente');
    });	