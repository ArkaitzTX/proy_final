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
}
