<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Models\Usuarios;
use App\Models\Proyectos;

class UsuarioController extends Controller
{
    //TODO: Login
    public function login(Request $request){
        // Buscar el usuario
        $usuario = Usuarios::where('nombre', $request->input('nombre'))->first();
        
        // Si existe
        if ($usuario && $request->pass === $usuario->pass) {
            session(['usuario' => $usuario]);
            return redirect()->route('inicio');
        }   

        // Si no
        return view('login')->with('mensaje', 'El usuario: ' . $request->nombre . ', es incorrecto o la contraseña no coincide');
    }

    public function logout(){
        // Cerrar secion
        session()->forget('usuario');
        return redirect()->route('inicio');
    }

    public function sign(Request $request){
        
        // Validar
        $request->validate([
            'nombre' => 'required|between:3,50|unique:usuarios,nombre',
            'pass1' => 'required|between:6,50',
        ]);

        // Comprobar contraseñas
        if ($request->pass1 !== $request->pass2) {
            return view('sign-up')->with('mensaje', 'Las contraseñas no coinciden.');
        }

        // Crear usuario
        $nuevo = new Usuarios();
        $nuevo->nombre = $request->nombre;
        $nuevo->pass = $request->pass1;
        $nuevo->img = 'default.png';
        $nuevo->admin = 0;
        $nuevo->save();
        
        // Iniciar secion
        session(['usuario' => $nuevo]);

        return redirect()->route('inicio');
    }

    //TODO: Perfil
    public function perfil($id){
        $usuario = Usuarios::findOrFail($id);
        return view('perfil', compact('usuario'));
    }

    public function actualizar(Request $request , $id){

        $usuario = Usuarios::findOrFail($id);

        if(!empty($request->nombre)){
            $request->validate([
                'nombre' => 'required|between:3,50|unique:usuarios,nombre',
            ]);

            $usuario->nombre = $request->nombre;
        }

        if(!empty($request->pass)){
            $request->validate([
                'pass' => 'required|between:6,50',
            ]);

            $usuario->pass = $request->pass;
        }


        if(!empty($request->img)) {

            $ruta = '/images/usuarios/';

            if (file_exists(public_path($ruta) . $usuario->img) && $usuario->img != "default.png") {
                unlink(public_path($ruta) . $usuario->img);
            }

            $foto = $request->file('img');
            $nombreFoto = $id . '.' . $foto->getClientOriginalExtension();
            $foto->move(public_path($ruta), $nombreFoto);


            $usuario->img = $nombreFoto;
        }

        $usuario->save();
        session(['usuario' =>  $usuario]);

        return back()->with('success', 'Los datos de la cuenta han sido actualizados con exito.');

    }   
    //TODO: Admin
        //Ver
    public function adminVer(){
        $usuarios = Usuarios::paginate(16);
        $proyectos = Proyectos::paginate(16);
        return view('admin', compact('usuarios','proyectos'));
    }
        //Delete
    public function adminDelete($id){
        $usuario = Usuarios::findOrFail($id);
        $usuario->eliminarProyectosYComentarios(); // Elimina los proyectos relacionados al usuario
        $usuario->delete(); // Elimina al usuario

        //Eliminar img de perfil
        if (file_exists(public_path('/images/usuarios/') . $usuario->img) && $usuario->img != "default.png") {
            unlink(public_path('/images/usuarios/') . $usuario->img);
        }

        return back();   
    }
        //Permisos
    public function adminPermisos($id){
        $usuario = Usuarios::findOrFail($id);
        $usuario->admin = $usuario->admin ? 0 : 1;
        $usuario->save();

        return back();  
    }

    public function idioma(Request $request){
        session(['idioma' =>  $request->idioma]);

        return back();  
    }
}
