<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;

class Categoria extends Model
{
    protected $table = "categorias";

    /** Relaciones entre modelos **/
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }
}
