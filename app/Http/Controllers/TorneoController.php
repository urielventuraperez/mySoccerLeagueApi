<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneo;
use App\Modals\Categoria;
use App\Modals\Responsable;

class TorneoController extends Controller
{
    //Ver Torneo
    public function viewAll(){
        return Torneo::verTorneos();
    }

    public function viewTournamentTeams($id){
        return Torneo::verEquiposTorneo($id);
    }

    //Crear torneo
    public function store(Request $request){
        return Torneo::agregarTorneo($request);
    }

    //Eliminar torneo
    public function delete($id){
        return Torneo::eliminarTorneo($id);
    }

    //Actualizar torneo
    public function update(Request $request, $id){
        return Torneo::actualizarTorneo($request, $id);
    }

    /** Ver arbitros del torneo **/
    public function viewTournamentReferees($tournamentId){
        return Torneo::verArbitrosTorneo($tournamentId);
    }

    /** Agregar Abitros al torneo **/
    public function addReferee($tournamentId){
        return Torneo::agregarArbitros($tournamentId);
    }
}
