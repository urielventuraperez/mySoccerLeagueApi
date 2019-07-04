<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = "responsables";

    public static function verTodosResponsables()
    {
        return json_encode(Responsable::all());
    }

    //Agregar Responsable
    public static function agregarResponsable($request)
    {
        $responsable = new Responsable();

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'celular' => 'required',
        ]);

        $responsable->nombre = $request->get('nombre');
        $responsable->apellido = $request->get('apellido');
        $responsable->alias = $request->get('alias');
        $responsable->celular = $request->get('celular');
        $responsable->edad = $request->get('edad');
        $responsable->es_torneo = $request->get('es_torneo');
        $responsable->es_equipo = !$request->get('es_torneo');
        $responsable->save();
    }

    public static function eliminarResponsable($id){
        return Responsable::destroy($id);
    }

}
