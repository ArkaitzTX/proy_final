<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyectos extends Model
{
    use HasFactory;
    protected $table = "proyectos";
    protected $primaryKey = "id";
    protected $fillable = ['nombre', 'descripcion', 'como', 'archivo', 'tipo', 'img', 'vista_prev', 'id_usuario'];
    // protected $hidden = ['id'];

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usuario', 'id');
    }

    public function comentarios()
    {
        return $this->hasMany(Comentarios::class, 'id_proy', 'id');
    }
}
