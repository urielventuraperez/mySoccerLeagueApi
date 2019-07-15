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
        return json_encode(Equipo::where('id', $id)->with('jugadores')->get());
    }

    public static function agregarEquipo($request, $idTorneo)
    {
        $equipo = new Equipo();
        $equipo->nombre = $request->get('nombre');
        $equipo->descripcion = $request->get('descripcion');
        $equipo->inscripcion_abono = $request->get('inscripcion_abono');
        $equipo->torneo_id = $idTorneo;

        /** Comparar el valor de la inscripcion del torneo **/
        if ($request->get('inscripcion_abono') == self::obtenerInscripcion($idTorneo)
            || $request->get('inscripcion_abono') >= self::obtenerInscripcion($idTorneo)) {
            $equipo->inscripcion = true;
        } else {
            $equipo->inscripcion = false;
        }

        if ($equipo->save()) {
            return response()->json([
                "message" => "Agregado con Exito",
            ]);
        } else {
            return response()->json([
                "message" => "Intentar de nuevo",
            ]);
        }
    }

    /** Metodo privado para obtener el costo de la inscripcion **/
    private static function obtenerInscripcion($idTorneo)
    {
        $torneo = Torneo::where('id', $idTorneo)->get();
        foreach ($torneo as $costo_inscripcion) {
            $costo = $costo_inscripcion->costo_inscripcion;
        }

        return $costo;
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
