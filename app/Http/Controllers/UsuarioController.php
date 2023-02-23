<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuarioController extends Controller
{
    //Login
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


                // if(!empty($request->image)) {

                //     $image = $request->image;

                //     $filename = uniqid() . '.' . $image->getClientOriginalExtension();

                //     $image->move(public_path('images/fotosPerfil'), $filename);        
                
                //     $usuario->img = $filename;
                // }
        
                $usuario->save();
        
                return redirect()->route('perfil')->with('success', 'Los datos de la cuenta han sido actualizados con exito.');

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
