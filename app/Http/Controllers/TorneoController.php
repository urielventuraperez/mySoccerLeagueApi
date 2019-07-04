<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Torneo;
use App\Modals\Categoria;
use App\Modals\Responsable;

class TorneoController extends Controller
{
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
}
