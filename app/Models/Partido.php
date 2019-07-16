<?php

namespace App\Models;

use App\Models\Equipo;
use App\Models\Jornada;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{

    private static function equiposPorTorneo($torneoId)
    {
        return Equipo::select('id')->
            where('torneo_id', $torneoId)
            ->get()->toArray();
    }

    private static function objectToArray($equipos)
    {
        foreach ($equipos as $equipo) {
            foreach ($equipo as $e) {
                $convertArray[] = $e;
            }
        }
        return $convertArray;
    }

    private static function roundRobin(array $equipos)
    {

        if (count($equipos) % 2 != 0) {
            array_push($equipos, null);
        }
        $visitante = array_splice($equipos, (count($equipos) / 2));
        $local = $equipos;
        for ($i = 0; $i < count($local) + count($visitante) - 1; $i++) {
            for ($j = 0; $j < count($local); $j++) {
                $jornada[$i][$j]["equipo_local_id"] = $local[$j];
                $jornada[$i][$j]["equipo_visitante_id"] = $visitante[$j];
                $jornada[$i][$j]["jornada"] = $i + 1;
            }
            /** Nuevos valores a iterar para no repetir los partidos **/
            if (count($local) + count($visitante) - 1 > 2) {
                $s = array_splice($local, 1, 1);
                $slice = array_shift($s);
                array_unshift($visitante, $slice);
                $test = array_push($local, array_pop($visitante));
            }
        }
        return $jornada;
    }

    private static function crearJornada(array $jornadas)
    {
        foreach ($jornadas as $j) {
            foreach ($j as $p) {
                $jornada[] = $p["jornada"];
            }
        }
        return array_values(array_unique($jornada));
    }

    private static function crearPartido(array $jornadas)
    {

    }

    public static function generarPartidos($torneoId)
    {
        $equipos = self::equiposPorTorneo($torneoId);
        $equiposArray = self::objectToArray($equipos);
        $jornadasCredas = self::roundRobin($equiposArray);

        //Guardar Jornadas
        $jornadasUnicas = self::crearJornada($jornadasCredas);
        Jornada::generarJornada($jornadasUnicas, $torneoId);

        //Guardar Partidos
        $partido = new Partido();
        foreach ($jornadasCredas as $u) {
            foreach ($u as $x) {
                $relacionJornada = Jornada::where('jornada', $x['jornada'])
                    ->where('torneo_id', $torneoId)->first();
                if (!Partido::where("equipo_visitante_id", $x['equipo_visitante_id'])
                    ->where("equipo_local_id", $x['equipo_local_id'])
                    ->where("jornada_id", $relacionJornada->id)->count()) {
                    $partido = new Partido();
                    $partido->equipo_visitante_id = $x['equipo_visitante_id'];
                    $partido->equipo_local_id = $x['equipo_local_id'];
                    $partido->jornada_id = $relacionJornada->id;
                    $partido->tipo_partido_id = 2;
                    $partido->save();
                }
            }
        }
        return "done";
    }

}
