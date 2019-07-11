<?php

namespace App\Models;

use App\Models\Torneo;
use Illuminate\Database\Eloquent\Model;

class Responsable extends Model
{
    protected $table = "responsables";

    public static function verTodosResponsables()
    {
        return json_encode(Responsable::all());
    }

    public static function verTorneoResponsables(){
        $responsables = Responsable::where('es_torneo', 1)->get();
        if ($responsables->count()){
            return $responsables;
        } else{
            return response()->json([
                "error" => "Sin Responsables"
            ]);
        }
    }

    //Agregar Responsable
    public static function agregarResponsable($request)
    {
        $responsable = new Responsable();

        try {
            $responsable->nombre = $request->get('nombre');
            $responsable->apellido = $request->get('apellido');
            $responsable->alias = $request->get('alias');
            $responsable->celular = $request->get('celular');
            $responsable->edad = $request->get('edad');
            $responsable->es_torneo = $request->get('es_torneo');
            $responsable->es_equipo = !$request->get('es_torneo');

            if ( !$responsable->save() ){
                return response()->json(["message" => "fallo"], 404);
            }

            return response()->json(["message" => "guardado"], 200);

        } catch (\Exception $e) {
            return response()->json(["message" => "fallo"], 404);
        }

    }

    public static function eliminarResponsable($id)
    {
        try{
            Responsable::destroy($id);
            return response()->json(["message" => "guardado"], 200);
        }
        catch(\Exception $e){
            return response()->json(["message" => "fallo"], 404);
        }
         
    }

    public static function actualizarResponsable($request, $id)
    {
        try{
            $responsable = Responsable::find($id);
            $responsable->nombre = $request->get('nombre');
            $responsable->apellido = $request->get('apellido');
            $responsable->alias = $request->get('alias');
            $responsable->celular = $request->get('celular');
            $responsable->edad = $request->get('edad');
            $responsable->es_torneo = $request->get('es_torneo');
            $responsable->es_equipo = !$request->get('es_torneo');
            $responsable->save();
            return response()->json(["message" => "guardado"], 200);
        }
        catch(\Exception $e){
            return response()->json(["message" => "fallo"], 404);
        }

    }

    /** Relaciones **/

    public function torneo()
    {
        return $this->hasOne(Torneo::class);
    }
}
