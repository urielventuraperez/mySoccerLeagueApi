<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Arbitro extends Model
{

    protected $table = "arbitros";

    public static function verTodosArbitros()
    {
        return json_encode(Arbitro::all());
    }

    public static function almacenarArbitro(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'celular' => 'required',
        ]);

        $arbitro = new Arbitro();
        $arbitro->nombre = $request->get('nombre');
        $arbitro->apellido = $request->get('apellido');
        $arbitro->alias = $request->get('alias');
        $arbitro->celular = $request->get('celular');
        $arbitro->timestamps = false;
        $arbitro->save();
    }

    public static function eliminarArbitro($id){
        return Arbitro::destroy($id);
    }

}
