<?php

namespace App\Http\Controllers;

use App\Models\Arbitro;
use Illuminate\Http\Request;

class ArbitroController extends Controller
{
    public function all()
    {
        $queryArbitros = Arbitro::verTodosArbitros();
        if ($queryArbitros) {
            foreach ($queryArbitros as $arbitro) {
                $arbitros[] = array(
                    "id" => $arbitro->id,
                    "nombre" => $arbitro->nombre . ' ' . $arbitro->apellido,
                    "alias" => $arbitro->alias,
                    "celular" => $arbitro->celular,
                    "torneos_dirigidos" => count($arbitro->torneos),
                );
            }
            return $arbitros;
        } else {
            response()->json([
                "message" => "error"
            ]);
        }

    }

    //Almacena un arbitro
    public function store(Request $request)
    {
        return Arbitro::almacenarArbitro($request);
    }

    //Eliminar un arbitro
    public function delete($id)
    {
        return Arbitro::eliminarArbitro($id);
    }

    //Actualizar un arbitro
    public function update(Request $request, $id)
    {
        return Arbitro::actualizarArbitro($request, $id);
    }

}
