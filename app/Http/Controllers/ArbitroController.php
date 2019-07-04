<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arbitro;

class ArbitroController extends Controller
{
    public function all(){
        return Arbitro::verTodosArbitros();
    }

    //Almacena un arbitro
    function store(Request $request){
        return Arbitro::almacenarArbitro($request);
    }

    //Eliminar un arbitro
    public function delete($id){
        return Arbitro::eliminarArbitro($id);
    }

    //Actualizar un arbitro
    public function update(Request $request, $id){
        return Arbitro::actualizarArbitro($request, $id);
    }

}
