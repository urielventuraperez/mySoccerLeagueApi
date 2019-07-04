<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;

class EquipoController extends Controller
{
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
