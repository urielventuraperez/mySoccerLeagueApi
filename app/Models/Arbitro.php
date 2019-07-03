<?php

namespace App\Models;


use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class Arbitro extends Model
{

    protected $table = "arbitros";

    public static function verTodosArbitros(){
        return json_encode(Arbitro::all());
    }

    public static function almacenarArbitro(Request $request){
        $arbitro = new Arbitro();
        $arbitro->nombre = $request->get('nombre');
        $arbitro->apellido = $request->get('apellido');
        $arbitro->alias = $request->get('alias');
        $arbitro->celular = $request->get('celular');
        $arbitro->timestamps = false;
        $arbitro->save();
    }
}
