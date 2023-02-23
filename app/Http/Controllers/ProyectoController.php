<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyectos;
use App\Models\Usuarios;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class ProyectoController extends Controller
{
    //Ver todos
    public function inicio(){
        $proyectos = Proyectos::paginate(16);
        return view('inicio', compact('proyectos'));
    }
    //Añadir
    public function nuevo(Request $request){

        // GENERAR NOMBRE DEL ARCHIVO
        $nombreArch = '';
        do {
            $nombreArch = Str::random(25);
        } while (Storage::exists("proyectos/images/" . $nombreArch));

        // AÑADIR EXTENCIONES AL ARCHIVO
            // IMG
            $nombreImg = ($request->file("img") != null)
                ? $nombreArch . "." . $request->file("img")->getClientOriginalExtension() 
                : "default.jpg";

            // CODIGO
            // $misTipos = array("css", "js", "json");
            // $nombreCod = $nombreArch . "." .$misTipos[$request->tipo];

        //! EN CASO DE QUE SEA JSON(BUG)
        $vPrev = 0;
        if ($request->tipo != 3) {
            $vPrev = $request->has('vista_prev') ? 0 : 1;
        }
        
        

        // CREAR PROYECTO
        $nuevo = new Proyectos();
        $nuevo->nombre = $request->nombre;
        $nuevo->descripcion = $request->descripcion;
        $nuevo->como = $request->como;
        $nuevo->archivo = $nombreArch;
        $nuevo->tipo = $request->tipo;
        $nuevo->img = $nombreImg;
        $nuevo->vista_prev = $vPrev;
        $nuevo->id_usuarios = session()->get('usuario')->id;
        $nuevo->save();

        // ARCHIVOS
            // IMAGEN
            if ($request->file("img") != null) {
                $request->file("img")->move(public_path('proyectos/images'), $nombreImg);
            }
            // ARCHIVOS
                //1
            $misTipos = array("css", "js", "json");
            $ruta1 = public_path('proyectos/'. $misTipos[$request->tipo-1] . '/');
            $arch1 = $request->archivo1;
            File::put($ruta1  . $nombreArch . '.' . $misTipos[$request->tipo-1], $arch1);
                //2
            if ($vPrev) {
                $ruta2 = public_path('proyectos/html/');
                $arch2 = $request->archivo2;
                File::put($ruta2 . $nombreArch . '.html', $arch2);
            }

        // RETURN
        return redirect()->route('inicio');
    }
    //Ver uno
    public function ver($id){
        $proyecto = Proyectos::findOrFail($id);
        return view('ver', compact('proyecto'));
    }

    public function delete($id){

        $proyecto = Proyectos::findOrFail($id);
        $proyecto->delete();

        // Actualizar session
        $usuario = Usuarios::findOrFail(session()->get('usuario')->id);
        session(['usuario' => $usuario]);


        return back();
    }

}
