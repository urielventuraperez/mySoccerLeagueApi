<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Responsable extends Model
{
    protected $table = "responsables";

    public static function verTodosResponsables(){
        return json_encode(Responsable::all());
    }

    //Agregar Responsable
    public static function agregarResponsable($request){
        $responsable = new Responsable();
        $responsable->nombre = $request->get('nombre');
        $responsable->apellido = $request->get('apellido');
        $responsable->alias = $request->get('alias');
        $responsable->celular = $request->get('celular');
        $responsable->edad = $request->get('edad');
        $responsable->es_torneo = $request->get('es_torneo');
        $responsable->es_equipo = !$request->get('es_torneo');
        $responsable->save();
    }
}
