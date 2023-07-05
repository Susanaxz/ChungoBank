<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CargarVistasController;
use App\Http\Controllers\PersonasController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/alta-movimientos', function () {
    return view('alta-movimientos');
});

Route::get('/alta-mto-puntos', function () {
    return view('alta-mto-puntos');
});


Route::get('/alta-personas', function () {
    return view('alta-personas');
});

Route::get('/consulta-movimientos', function () {
    return view('consulta-movimientos');
});

Route::get('/detalle-movimiento', function () {
    return view('detalle-movimiento');
});

Route::get('/', function () {
    return view('gestion');
});


Route::get('/gestion', function () {
    return view('gestion');
});

// Route::get('/gestion', [PersonasController::class, 'gestion'])->name('gestion');


Route::get('/personas/{nif}', [App\Http\Controllers\PersonasController::class, 'consulta']);

// Route::get('/login', function () {
//     return view('login');
// });

Route::post('/personas', [App\Http\Controllers\PersonasController::class, 'alta'])->name('personas.alta');
