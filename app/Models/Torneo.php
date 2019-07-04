<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;
use App\Models\Responsable;
use App\Models\Equipo;

class Torneo extends Model
{
    protected $table = "torneos";

    //Agregar Torneo
    public static function agregarTorneo($request){
        $torneo = new Torneo();
        $torneo->nombre = $request->get('nombre');
        $torneo->valor_inscripcion = $request->get('valor_inscripcion');
        $torneo->valor_arbitraje = $request->get('valor_arbitraje');
        $torneo->categoria_id = $request->get('categoria_id');
        $torneo->responsable_id = $request->get('responsable_id');
        $torneo->save();
    }

    public static function eliminarTorneo($id){
        return Torneo::destroy($id);
    }

    public static function actualizarTorneo($request, $id){
        $torneo = Torneo::find($id);
        $torneo->nombre = $request->get('nombre');
        $torneo->valor_inscripcion = $request->get('valor_inscripcion');
        $torneo->valor_arbitraje = $request->get('valor_arbitraje');
        $torneo->categoria_id = $request->get('categoria_id');
        $torneo->responsable_id = $request->get('responsable_id');
        $torneo->save();
    }

    //Relaciones
    public function responsable(){
        return $this->hasOne(Responsable::class);
    }

    public function categoria()
    {
        return $this->hasOne(Categoria::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }
}
