<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;
use App\Models\TipoPartido;

class Jornada extends Model
{
    protected $table = "jornadas";

    public static function agregarJornada($request){
        $jornada = new Jornada();
        $jornada->jornada = $request->get('jornada');
        $jornada->torneo_id = $request->get('tipo_partido_id');
        $jornada->tipo_partido_id = $request->get('tipo_partido_id');
        $jornada->save();
    }

    public static function eliminarJornada($id){
        return Jornada::destroy($id);
    }

    public static function actualizarJornada($request, $id){
        $jornada = Jornada::find($id);
        $jornada->jornada = $request->get('jornada');
        $jornada->torneo_id = $request->get('torneo_id');
        $jornada->tipo_partido_id = $request->get('tipo_partido_id');
        $jornada->save();
    }

    /** Relaciones entre modelos **/
    public function torneo()
    {
        return $this->hasOne(Torneo::class);
    }

    public function tipo_partido_id()
    {
        return $this->hasOne(TipoPartido::class);
    }
}
