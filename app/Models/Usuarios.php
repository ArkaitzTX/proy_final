<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;
    protected $table = "usuarios";
    protected $primaryKey = "id";
    protected $fillable = ['nombre', 'pass', 'img', 'admin'];
    // protected $hidden = ['id'];

    public function proyectos()
    {
        return $this->hasMany(Proyectos::class, 'id_usuarios', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class, 'id_usu', 'id');
    }

    public function eliminarProyectosYComentarios()
    {
        foreach ($this->proyectos as $proyecto) {
            // Eliminar los archivos del proyecto
            $misTipos = array("css", "js", "json");
            $archivo1 = public_path('/proyectos/' . $misTipos[$proyecto->tipo-1] . '/') . $proyecto->archivo . '.' . $misTipos[$proyecto->tipo-1];
    
            if (file_exists($archivo1)) {
                unlink($archivo1);
            }
    
            if ($proyecto->vista_prev) {
                $archivo2 = public_path('/proyectos/html/') . $proyecto->archivo . '.html';
    
                if (file_exists($archivo2)) {
                    unlink($archivo2);
                }
            }
    
            // Eliminar los comentarios del proyecto
            $proyecto->comentarios()->delete();
    
            // Eliminar el proyecto
            $proyecto->delete();
        }
    }
}
