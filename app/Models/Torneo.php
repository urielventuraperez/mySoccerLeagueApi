<?php

namespace App\Models;

use App\Models\Arbitro;
use App\Models\Categoria;
use App\Models\Equipo;
use App\Models\Jornada;
use App\Models\Responsable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Torneo extends Model
{
    protected $table = "torneos";

    //Ver Torneos
    public static function verTorneos()
    {
        $torneos = DB::table('responsables')
            ->join('torneos', 'responsables.id', '=', 'torneos.responsable_id')
            ->join('categorias', 'torneos.categoria_id', 'categorias.id')
            ->select(
                'torneos.id',
                'torneos.nombre',
                'torneos.valor_inscripcion',
                'torneos.valor_arbitraje',
                'responsables.nombre as responsable_nombre',
                'responsables.apellido as responsable_apellido',
                'categorias.nombre as categoria')
            ->groupBy('torneos.id')
            ->get();
        return json_encode($torneos);
    }

    public static function verEquiposTorneo($id){
        $equiposTorneo = Equipo::where('torneo_id', $id)->get();
        if($equiposTorneo->count()){
            return json_encode($equiposTorneo);
        }
        else{
            $returnData = array(
                'status' => 'error',
                'message' => 'Sin Equipos!'
            );
            return json_encode($returnData, 500);
        }
    }

    //Agregar Torneo
    public static function agregarTorneo($request)
    {
        $torneo = new Torneo();
        $torneo->nombre = $request->get('nombre');
        $torneo->valor_inscripcion = $request->get('valor_inscripcion');
        $torneo->valor_arbitraje = $request->get('valor_arbitraje');
        $torneo->categoria_id = $request->get('categoria_id');
        $torneo->responsable_id = $request->get('responsable_id');
        $torneo->save();
    }

    public static function eliminarTorneo($id)
    {
        return Torneo::destroy($id);
    }

    public static function actualizarTorneo($request, $id)
    {
        $torneo = Torneo::find($id);
        $torneo->nombre = $request->get('nombre');
        $torneo->valor_inscripcion = $request->get('valor_inscripcion');
        $torneo->valor_arbitraje = $request->get('valor_arbitraje');
        $torneo->categoria_id = $request->get('categoria_id');
        $torneo->responsable_id = $request->get('responsable_id');
        $torneo->save();
    }

    public static function agregarArbitros($idTorneo)
    {
        $torneo = Torneo::find($idTorneo);
        $arbitros = Arbitro::all('id');

        foreach ($arbitros as $arbitro) {
            $torneo->arbitros()->attach([$idTorneo => ['arbitro_id' => $arbitro->id]]);
        }

    }

    //Relaciones entre modelos
    public function responsable()
    {
        return $this->belongsTo(Responsable::class);
    }

    public function categoria()
    {
        return $this->hasOne(Categoria::class);
    }

    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    public function jornada()
    {
        return $this->belongsTo(Jornada::class);
    }

    public function arbitros()
    {
        return $this->belongsToMany(Arbitro::class, 'torneo_arbitro')->withTimestamps();
    }

}
