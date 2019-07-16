<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partido;

class PartidoController extends Controller{

    public function createPlayRoles($tournamentId){
        return Partido::generarPartidos($tournamentId);
    }

}