<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Equipo;

class Jugador extends Model
{
    protected $table = "jugadores";

    public static function verTodosJugadores(){
        return json_encode(Jugador::all());
    }

    /** Agregar Jugador **/
    public static function agregarJugador($request)
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
        return Jugador::destroy($id);
    }

    public static function actualizarJugador($request, $id){
        $jugador = Jugador::find($id);
        $jugador->nombre = $request->get('nombre');
        $jugador->apellido = $request->get('apellido');
        $jugador->alias = $request->get('alias');
        $jugador->edad = $request->get('edad');
        $jugador->celular = $request->get('celular');
        $jugador->timestamps = false;
        $jugador->save();
    }

    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_jugador');
    }
}