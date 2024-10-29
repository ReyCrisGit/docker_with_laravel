<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    protected $table = 'imagenes';

    protected $fillable = ['ruta', 'imageable_id', 'imageable_type'];

    public function imageble()
    {
        return $this->morphTo();
    }
}
