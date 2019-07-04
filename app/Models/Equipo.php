<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Torneo;

class Equipo extends Model
{
    protected $table = "equipos";

    public static function agregarEquipo($request){
        $equipo = new Equipo();
        $equipo->nombre = $request->get('nombre');
        $equipo->descripcion = $request->get('descripcion');
        $equipo->inscripcion = $request->get('inscripcion');
        $equipo->inscripcion_abono = $request->get('inscripcion_abono');
        $equipo->torneo_id = $request->get('torneo_id');
        $equipo->save();
    }

    public static function eliminarEquipo($id){
        return Equipo::destroy($id);
    }

    public static function actualizarEquipo($request, $id){
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
}
