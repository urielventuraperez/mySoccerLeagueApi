<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = "jugadores";

    public static function verTodosJugadores(){
        return json_encode(Jugador::all());
    }

    /** Agregar Jugador **/
    public static function agregarJugador(Request $request)
    {
        $jugador = new Jugador();

       $request->validate([ 
           'nombre'=>'required',
           'apellido'=>'required',
           'celular'=>'required' 
           ]); 

        $jugador->nombre = $request->get('nombre');
        $jugador->apellido = $request->get('apellido');
        $jugador->alias = $request->get('alias');
        $jugador->celular = $request->get('celular');
        $jugador->edad = $request->get('edad');
        $jugador->timestamps = false;
        $jugador->save();
    }

    public static function eliminarJugador($id){
        return Jugador::where($id)->delete();
    }

}