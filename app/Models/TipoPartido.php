<?php

namespace App\Models;
use App\Models\Jornada;

use Illuminate\Database\Eloquent\Model;

class TipoPartido extends Model
{
    protected $table = "tipo_partidos";

    /** Relaciones entre modelos **/
    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }
}
