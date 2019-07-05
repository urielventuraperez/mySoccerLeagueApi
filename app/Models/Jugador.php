<?php

namespace App\Models;

use App\Models\Equipo;
use Illuminate\Database\Eloquent\Model;

class Jugador extends Model
{
    protected $table = "jugadores";

    /** CONSTANTES **/
    //Estadistica Goles
    //Goles
    const INITGOLES = 1;
    //Tipo
    const ESTADISTICAGOL = 'GOL';

    //Estadistica Faltas
    //Faltas
    const INITFALTAS = 1;
    //Tipo
    const ESTADISTICAFALTA = 'FALTA';

    //Estadistica Amonestaciones
    const INITAMONESTACIONES = 1;
    //Tipo
    const ESTADISTICAAMONESTACION = 'AMONESTACION';

    //Estadistica Expulsiones
    const INITEXPULSIONES = 1;
    //Tipo
    const ESTADISTICAEXPULSION = 'EXPULSION';

    public static function verTodosJugadores()
    {
        return json_encode(Jugador::all());
    }

    /** Agregar Jugador **/
    public static function agregarJugador($request)
    {
        $jugador = new Jugador();

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'celular' => 'required',
        ]);

        $jugador->nombre = $request->get('nombre');
        $jugador->apellido = $request->get('apellido');
        $jugador->alias = $request->get('alias');
        $jugador->celular = $request->get('celular');
        $jugador->edad = $request->get('edad');
        $jugador->timestamps = false;
        $jugador->save();
    }

    public static function eliminarJugador($id)
    {
        return Jugador::destroy($id);
    }

    public static function actualizarJugador($request, $id)
    {
        $jugador = Jugador::find($id);
        $jugador->nombre = $request->get('nombre');
        $jugador->apellido = $request->get('apellido');
        $jugador->alias = $request->get('alias');
        $jugador->edad = $request->get('edad');
        $jugador->celular = $request->get('celular');
        $jugador->timestamps = false;
        $jugador->save();
    }

    /** Estadisticas por jugador en el equipo **/

    private static function estadisticasJugadorEquipo($idJugador, $idEquipo)
    {
        $estadisticaJugador = [];
        /** Query **/
        $jugadorEquipo = Jugador::where('id', $idJugador)
            ->whereHas('equipo', function ($q) use ($idEquipo) {
                $q->where('id', $idEquipo);
            })
            ->with('equipo')
            ->get();

        foreach ($jugadorEquipo as $jugador) {
            foreach ($jugador->equipo as $estadistica) {
                $estadisticaJugador[] = $estadistica->pivot;
            }
        }

        return json_encode($estadisticaJugador);
    }

    private static function elegirEstadistica($tipo, $idJugador, $idEquipo)
    {
        $estadisticasJugador = json_decode(
            self::estadisticasJugadorEquipo($idJugador, $idEquipo));
        foreach ($estadisticasJugador as $estadistica) {
            switch ($tipo) {
                case 'GOL':
                    return $estadistica->gol;
                case 'FALTA':
                    return $estadistica->falta;
                case 'AMONESTACION':
                    return $estadistica->amonestacion;
                case 'EXPULSION':
                    return $estadistica->expulsion;
                default:
                    return ["message" => "sin valor"];
                    break;
            }
        }
    }

    /** Clases para calcular estadisticas del jugador por equipo **/
    public static function golJugador($idJugador, $idEquipo)
    {
        $jugador = Jugador::find($idJugador);
        $equipo = Equipo::find($idEquipo);
        $estadistica = self::elegirEstadistica(self::ESTADISTICAGOL, $idJugador, $idEquipo);

        $total = $estadistica + self::INITGOLES;

        $jugador->equipo()->sync([$equipo->id => ['gol' => $total]]);
    }

    public static function faltaJugador($idJugador, $idEquipo)
    {
        $jugador = Jugador::find($idJugador);
        $equipo = Equipo::find($idEquipo);
        $estadistica = self::elegirEstadistica(self::ESTADISTICAFALTA, $idJugador, $idEquipo);

        $total = $estadistica + self::INITFALTAS;

        $jugador->equipo()->sync([$equipo->id => ['falta' => $total]]);
    }

    public static function amonestacionJugador($idJugador, $idEquipo)
    {
        $jugador = Jugador::find($idJugador);
        $equipo = Equipo::find($idEquipo);
        $estadistica = self::elegirEstadistica(self::ESTADISTICAAMONESTACION, $idJugador, $idEquipo);

        $total = $estadistica + self::INITAMONESTACIONES;

        $jugador->equipo()->sync([$equipo->id => ['amonestacion' => $total]]);
    }

    public static function expulsionJugador($idJugador, $idEquipo)
    {
        $jugador = Jugador::find($idJugador);
        $equipo = Equipo::find($idEquipo);
        $estadistica = self::elegirEstadistica(self::ESTADISTICAEXPULSION, $idJugador, $idEquipo);

        $total = $estadistica + self::INITEXPULSIONES;

        $jugador->equipo()->sync([$equipo->id => ['expulsion' => $total]]);
    }

    /** Relaciones entre modelos **/
    public function equipo()
    {
        return $this->belongsToMany(Equipo::class, 'equipo_jugador')->withPivot(
            'gol', 'falta', 'amonestacion', 'expulsion');
    }
}
