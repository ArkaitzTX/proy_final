<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;
    protected $table = "comentarios";
    protected $primaryKey = "id";
    protected $fillable = ['texto', 'id_padre', 'id_proy', 'id_usu'];
    protected $hidden = ['id'];

    public function proyectos()
    {
        return $this->belongsTo(Proyectos::class, 'id_proy', 'id');
    }

    public function usuarios()
    {
        return $this->belongsTo(Usuarios::class, 'id_usu', 'id');
    }
}
