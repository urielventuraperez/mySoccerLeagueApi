<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Responsable;

class ResponsableController extends Controller
{
    public function all(){
        return Responsable::verTodosResponsables();
    }

    //Store Responsable
    public function store(Request $request){
        return Responsable::agregarResponsable($request);
    }

    //Delete Responsable
    public function delete($id){
        return Responsable::eliminarResponsable($id);
    }

    //Update Responsable
    public function update(Request $request, $id){
        return Responsable::actualizarResponsable($request, $id);
    }
}
