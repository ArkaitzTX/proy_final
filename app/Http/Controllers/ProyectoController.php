<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proyectos;

class ProyectoController extends Controller
{
    public function inicio(Request $request){

        $proyectos = Proyectos::paginate(16);
        return view('inicio', compact('proyectos'));

    }

    //Ver todos
    //Añadir
    //Ver uno
}
