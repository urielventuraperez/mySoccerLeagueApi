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
}
