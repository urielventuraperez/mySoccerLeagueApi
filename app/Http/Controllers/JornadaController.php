<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jornada;
use App\Models\Equipo;

class JornadaController extends Controller
{
    //Crear Jornada
    public function store(Request $request){
        return Jornada::agregarJornada($request);
    }
    //Eliminar Jornada
    public function delete($id){
        return Jornada::eliminarJornada($id);
    }
    //Actualizar Jornada
    public function update(Request $request, $id){
        return Jornada::actualizarJornada($request, $id);
    }
    //Equipos en Jornada
    public function addTeam($idJornada){
        return Jornada::agregarEquiposJornada($idJornada);
    }
    //Ver todas las jornadas del torneo
    public function viewAllMatches($idTorneo){
        return Jornada::verTodasJornadas($idTorneo);
    }

    //Ver Jornadas especifica
    public function viewMatches($idTorneo,$idJornada){
        $jornada = [];
        $queryResult = Jornada::verJornadas($idTorneo, $idJornada);

        //Loop query
        foreach($queryResult as $result){
            foreach($result->partidos as $partido){
                $jornada[$result->jornada][] =  array("visitante"=>Equipo::find($partido->equipo_visitante_id, ["nombre"]), "local"=>Equipo::find($partido->equipo_local_id, ["nombre"]));
            }
        }
    
        return $jornada;
    }
}
