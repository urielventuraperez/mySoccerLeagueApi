<?php

namespace App\Models;

use App\Models\Equipo;
use App\Models\TipoPartido;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $table = "jornadas";

    public static function agregarJornada($request)
    {
        $jornada = new Jornada();
        $jornada->jornada = $request->get('jornada');
        $jornada->torneo_id = $request->get('tipo_partido_id');
        $jornada->tipo_partido_id = $request->get('tipo_partido_id');
        $jornada->save();
    }

    public static function eliminarJornada($id)
    {
        return Jornada::destroy($id);
    }

    public static function actualizarJornada($request, $id)
    {
        $jornada = Jornada::find($id);
        $jornada->jornada = $request->get('jornada');
        $jornada->torneo_id = $request->get('torneo_id');
        $jornada->tipo_partido_id = $request->get('tipo_partido_id');
        $jornada->save();
    }

    public static function agregarEquiposJornada($idJornada)
    {
        $jornada = Jornada::find($idJornada);
        $equipos = Equipo::all('id');

        foreach ($equipos as $equipo) {
            $jornada->equipos()->attach([$jornada->jornada => ['equipo_id' => $equipo->id]]);
        }
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

    public function equipos()
    {
        return $this->belongsToMany(Equipo::class, 'jornada_equipo');
    }
}
