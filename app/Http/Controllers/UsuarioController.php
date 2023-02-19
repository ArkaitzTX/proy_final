<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    //Login
    public function login(Request $request){
        // Buscar el usuario
        $usuario = Usuarios::where('nombre',$request->nombre)->get()[0];
        
        // Si existe
        if($request->pass == $usuario->pass){
            session(['usuario' => $usuario]);
            return redirect()->route('inicio');
        }   

        // Si no
        return view('login')->with('mensaje', 'El usuario: ' . $request->nombre . ', es incorrecto o la contraseña no coincide');
    }

    public function logout(Request $request){
        // Cerrar secion
        session()->forget('usuario');
        return redirect()->route('inicio');
    }

    public function sign(Request $request){
        
        // Validar
        $request->validate([
            'nombre' => 'required|between:3,50|unique',
            'pass' => 'required|between:5,50',
        ]);

        // Comprobar contraseñas
        if ($request->pass1 !== $request->pass2) {
            return view('sign')->with('mensaje', 'Las contraseñas no coinciden.');
        }

        // Crear usuario
        $nuevo = new Usuarios();
        $nuevo->nombre = $request->nombre;
        $nuevo->pass = $request->pass1;
        $nuevo->usuario = $request->usuario;
        $nuevo->img = 'default.jpg';
        $nuevo->admin = 0;
        $nuevo->save();
        
        // Iniciar secion
        session(['usuario' => $nuevo]);

        return redirect()->route('inicio');
    }
    //Register
    //Perfil
        //Ver
        //Update
        //Delete
    //Admin
        //Ver
        //Update
        //Delete
}
