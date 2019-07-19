<?php

namespace App\Models;

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Arbitro extends Model
{

    protected $table = "arbitros";

    public static function verTodosArbitros()
    {
        return Arbitro::with('Torneos')->get();
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

    public static function eliminarArbitro($id)
    {
        return Arbitro::destroy($id);
    }

    public static function actualizarArbitro($request, $id)
    {
        $arbitro = Arbitro::find($id);
        $arbitro->nombre = $request->get('nombre');
        $arbitro->apellido = $request->get('apellido');
        $arbitro->alias = $request->get('alias');
        $arbitro->celular = $request->get('celular');
        $arbitro->timestamps = false;
        $arbitro->save();
    }

    /** Relaciones entre modelos **/
    public function Torneos()
    {
        return $this->belongsToMany(Torneo::class, 'torneo_arbitro')
            ->withPivot('torneo_id')
            ->withTimestamps();
    }
}
