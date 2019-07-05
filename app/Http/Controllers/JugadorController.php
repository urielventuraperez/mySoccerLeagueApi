<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jugador;

class JugadorController extends Controller
{

    public function all(){
        return Jugador::verTodosJugadores();
    }

    public function store(Request $request){
        return Jugador::agregarJugador($request);
    }

    public function delete($id){
        return Jugador::eliminarJugador($id);
    }

    public function update(Request $request, $id){
        return Jugador::actualizarJugador($request, $id);
    }

    /** Estadisticas Jugador por Equipo **/
    public function gol($idJugador, $idEquipo){
        return Jugador::golJugador($idJugador, $idEquipo);
    }

    public function falta($idJugador, $idEquipo){
        return Jugador::faltaJugador($idJugador, $idEquipo);
    }

    public function amonestacion($idJugador, $idEquipo){
        return Jugador::amonestacionJugador($idJugador, $idEquipo);
    }

    public function expulsion($idJugador, $idEquipo){
        return Jugador::expulsionJugador($idJugador, $idEquipo);
    }

}
