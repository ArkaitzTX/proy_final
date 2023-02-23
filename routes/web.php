<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProyectoController;
use App\Http\Controllers\UsuarioController;

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

//LOGIN/GIGN-UP
Route::get('/login', function () {
    return view('login');
})->name('login');
Route::get('/sign', function () {
    return view('sign-up');
})->name('sign');
Route::post('/login', [UsuarioController::class, 'login'])->name('login-a');
Route::get('/logout', [UsuarioController::class, 'logout'])->name('logout');
Route::post('/sign', [UsuarioController::class, 'sign'])->name('sign-a');

Route::group(['middleware' => 'usuarios'], function(){
	//NUEVO
    Route::get('/new', function () {
        return view('nuevo');
    })->name('nuevo');
    Route::post('/new', [ProyectoController::class, 'nuevo'])->name('nuevoCrear');

    //VER
    Route::get('/view/{id}', [ProyectoController::class, 'ver'])->name('ver');

    //ADMIN
    Route::get('/admin', [UsuarioController::class, 'adminVer'])->name('admin');
    Route::delete('/admin/{id}', [UsuarioController::class, 'adminDelete'])->name('adminDelete');

    //PERFIL
    Route::get('/perfil/{id}', [UsuarioController::class, 'perfil'])->name('perfil');
    Route::put('/actualizarPefil{id}', [UsuarioController::class, 'actualizar'])->name('actualizarPefil');

});


