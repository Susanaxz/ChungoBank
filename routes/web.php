<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargarVistasController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\CuentasController;
use App\Http\Controllers\MovimientosController;

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

Route::get('/', function () {
    return view('/gestion');
});

Route::get('/gestion', function () {
    return view('/gestion');
});

Route::get('/alta-movimientos', function () {
    return view('alta-movimientos');
});
// Route::get('/programa-descripcion/{codigo}', 'CargarVistasController@getDescripcionPrograma');

// Route::match(['get', 'head', 'put', 'post'], '/alta-mto-puntos', 'App\Http\Controllers\CargarVistasController@modificarCuenta')->name('modificar.cuenta');
Route::put('/modificar/{persona}', 'App\Http\Controllers\CuentasController@modificarCuenta')->name('modificar.cuenta');

Route::post('/alta/{persona_id}', 'App\Http\Controllers\CuentasController@altaCuenta')->name('alta.cuenta');



Route::get('/alta-mto-puntos', [CargarVistasController::class, 'altaMtoPuntos']);

Route::get('/cuentas/{persona}', [CuentasController::class, 'consulta'])->name('cuentas.consulta');

Route::delete('/destroy/{cuenta}', [CuentasController::class, 'destroy'])->name('destroy.cuenta');

Route::delete('/personas/{persona_id}', [PersonasController::class, 'destroy']);


Route::get('/alta-personas', function () {
    return view('alta-personas');
});

Route::get('/consulta-movimientos', function () {
    return view('consulta-movimientos');
});

Route::get('/consulta-movimientos/{id}', [MovimientosController::class, 'consultaMovimientos'])->name('consulta-movimientos');



Route::get('/detalle-movimiento', function () {
    return view('detalle-movimiento');
});

Route::get('/personas/{nif}', [PersonasController::class, 'consulta']);

Route::get('/personas/{id}', [PersonasController::class, 'show'])->name('personas.show');

Route::post('/personas', [PersonasController::class, 'alta'])->name('personas.alta');

Route::get('/personas', [PersonasController::class, 'showForm'])->name('personas.showForm');

Route::get('/alta-personas', [PersonasController::class, 'showForm'])->name('personas.showForm'); // Ruta para mostrar el formulario de alta de personas (GET)