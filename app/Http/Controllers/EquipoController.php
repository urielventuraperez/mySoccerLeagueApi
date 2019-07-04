<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
    //Ver Equipo
    public function viewTeam($id){
        return Equipo::verEquipo($id);
    }

    //Añadir Equipo
    public function store(Request $request){
        return Equipo::agregarEquipo($request);
    }

    //Eliminar Equipo
    public function delete($id){
        return Equipo::eliminarEquipo($id);
    }

    //Actualizar Equipo
    public function update(Request $request, $id){
        return Equipo::actualizarEquipo($request, $id);
    }
}
