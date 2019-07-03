<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arbitro;

class ArbitroController extends Controller
{
    //Almacena un arbitro
    function store(Request $request){
        return Arbitro::almacenarArbitro($request);
    }

}
