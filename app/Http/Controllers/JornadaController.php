<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jornada;

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
}
