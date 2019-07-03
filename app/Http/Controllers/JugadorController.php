<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;

class JugadorController extends Controller
{
    public function store(Request $request){
        return Jugador::agregarJugador($request);
    }
}
