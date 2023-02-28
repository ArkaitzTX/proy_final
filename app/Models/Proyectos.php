<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table = "proyectos";
    protected $primaryKey = "id";
    protected $fillable = ['nombre', 'descripcion', 'como', 'archivo', 'tipo', 'img', 'vista_prev', 'id_usuarios'];
    // protected $hidden = ['id'];

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuarios', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class, 'id_proy', 'id');
    }

    public function eliminarProyecto()
    {
        $this->comentarios()->delete();
        $this->delete();
    }
}
