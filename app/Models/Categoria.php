<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;

class Categoria extends Model
{
    protected $table = "categorias";

    public static function verTodos(){
        $categorias = Categoria::all();
        if($categorias->count()){
            return json_encode($categorias);
        }else{
            return response()->json([
                'error' => 'Sin Categorias',
            ]);
        }
    }

    /** Relaciones entre modelos **/
    public function torneo()
    {
        return $this->belongsTo(Torneo::class);
    }
}
