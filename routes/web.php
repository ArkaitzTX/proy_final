<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;

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

//INDEX
Route::get('/', [ProyectoController::class, 'inicio'])->name('inicio');
Route::get('/#projects', [ProyectoController::class, 'inicio'])->name('proyectos');

//NUEVO
Route::get('/new', function () {
    return view('nuevo');
})->name('nuevo');
Route::post('/new', [ProyectoController::class, 'nuevo'])->name('nuevoCrear');

//VER
//Login
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/sign', function () {
    return view('sign-up');
})->name('sign');
//Perfil
//Admin
