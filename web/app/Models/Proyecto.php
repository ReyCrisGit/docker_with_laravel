<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    protected $table = 'proyectos';

    protected $fillable = ['nombre', 'descripcion', 'enlace'];

    public function imagenes()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }
}
