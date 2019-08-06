<?php

namespace App\Models;

use App\Models\Equipo;
use App\Models\TipoPartido;
use App\Models\Torneo;
use App\Models\Partido;
use Illuminate\Database\Eloquent\Model;

class Jornada extends Model
{
    protected $table = "jornadas";
    protected $fillable = ['id'];

    public static function agregarJornada($request)
    {
        $jornada = new Jornada();
        $jornada->jornada = $request->get('jornada');
        $jornada->torneo_id = $request->get('tipo_partido_id');
        $jornada->tipo_partido_id = $request->get('tipo_partido_id');
        $jornada->save();
    }

    /** Generar Jornadas **/
    public static function generarJornada(array $jornadas, $torneoId)
    {
        foreach ($jornadas as $u) {
            if (!Jornada::where("jornada", $u)->where("torneo_id", $torneoId)->count()) {
                $jornada = new Jornada();
                $jornada->jornada = $u;
                $jornada->torneo_id = $torneoId;
                $jornada->save();
            } 
        }
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

    public static function verTodasJornadas($idTorneo){
        return Jornada::where('torneo_id', $idTorneo)->where('finalizado', 0)->with('partidos')->get();
    }

    public static function verJornadas($idTorneo,$idJornada)
    {
        return Jornada::where('id', $idJornada)->where('torneo_id', $idTorneo)->with('partidos')->get();
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
    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }
}
