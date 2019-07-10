<?php

namespace App\Models;

use App\Models\Jornada;
use App\Models\Jugador;
use App\Models\Torneo;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    protected $table = "equipos";

    public static function verEquipo($id)
    {
        return Equipo::where('id', $id)->with('jugadores')->get();
    }

    public static function agregarEquipo($request)
    {
        $equipo = new Equipo();
        $equipo->nombre = $request->get('nombre');
        $equipo->descripcion = $request->get('descripcion');
        $equipo->inscripcion = $request->get('inscripcion');
        $equipo->inscripcion_abono = $request->get('inscripcion_abono');
        $equipo->torneo_id = $request->get('torneo_id');
        $equipo->save();
    }

    public static function eliminarEquipo($id)
    {
        return Equipo::destroy($id);
    }

    public static function actualizarEquipo($request, $id)
    {
        $equipo = Equipo::find($id);
        $equipo->nombre = $request->get('nombre');
        $equipo->descripcion = $request->get('descripcion');
        $equipo->inscripcion = $request->get('inscripcion');
        $equipo->inscripcion_abono = $request->get('inscripcion_abono');
        $equipo->torneo_id = $request->get('torneo_id');
        $equipo->save();
    }

    /** Relaciones entre modelos **/
    public function torneo()
    {
        return $this->hasOne(Torneo::class);
    }

    public function jugadores()
    {
        return $this->belongsToMany(Jugador::class, 'equipo_jugador')
            ->withPivot('gol', 'falta', 'amonestacion', 'expulsion');
    }

    public function jornadas()
    {
        return $this->belongsToMany(Jornada::class, 'jornada_equipo');
    }
}
