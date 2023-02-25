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
Route::get('/#proyectos', [ProyectoController::class, 'inicio'])->name('proyectos');

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

//VER PROYECTO
Route::get('/view/{id}', [ProyectoController::class, 'ver'])->name('ver');


Route::group(['middleware' => 'usuarios'], function(){
	//NUEVO PROYECTO
    Route::get('/new', function () {
        return view('nuevo');
    })->name('nuevo');
    Route::post('/new', [ProyectoController::class, 'nuevo'])->name('nuevoCrear');

    //ADMIN
    Route::get('/admin', [UsuarioController::class, 'adminVer'])->name('admin');
    Route::delete('/admin/{id}', [UsuarioController::class, 'adminDelete'])->name('adminDelete');
    Route::post('/admin/{id}', [UsuarioController::class, 'adminPermisos'])->name('adminPermisos');

    //ADMIN
    Route::get('/admin', [UsuarioController::class, 'adminVer'])->name('admin');
    Route::delete('/admin/{id}', [UsuarioController::class, 'adminDelete'])->name('adminDelete');

    //PERFIL
    Route::get('/profile/{id}', [UsuarioController::class, 'perfil'])->name('perfil');              // Route::get('/perfil/{id}', [UsuarioController::class, 'perfil'])->name('perfil');
    Route::put('/update/{id}', [UsuarioController::class, 'actualizar'])->name('actualizarPefil');  // Route::put('/actualizarPefil{id}', [UsuarioController::class, 'actualizar'])->name('actualizarPefil');

    //ELIMINAR PROYECTO
    Route::get('/delete/{id}', [ProyectoController::class, 'delete'])->name('borrarProyecto');      // Route::get('/borrarProyecto/{id}', [ProyectoController::class, 'delete'])->name('borrarProyecto');
    
    //EDIT Y UPDATE PROYECTO
    Route::get('/proyedit/{id}', [ProyectoController::class, 'edit'])->name('proyedit');
    Route::put('/proyupdate/{id}', [ProyectoController::class, 'update'])->name('proyupdate');

    //COMENTARIOS
    Route::post('/updatecoment', [ProyectoController::class, 'insertarCom'])->name('insertarCom');
    Route::delete('/deletecoment/{id}', [ProyectoController::class, 'eliminarCom'])->name('eliminarCom');
});


