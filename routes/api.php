<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

/** 
 * Usuarios
 * **/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Auth\AuthController@login')->name('login');
    Route::post('register', 'Auth\AuthController@register');
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::post('logout', 'Auth\AuthController@logout');
        Route::get('user', 'Auth\AuthController@user');
    });
});

/** Categorias **/
Route::get('verCategorias', 'CategoriaController@viewAll')->name('verCategorias');

//->middleware('auth:api') add to the route with special access

/** Torneos **/
Route::get('verTorneos', 'TorneoController@viewAll')->name('verTorneos');
Route::get('torneo/{id}/equipos', 'TorneoController@viewTournamentTeams');
Route::get('torneo/{id}/arbitros', 'TorneoController@viewTournamentReferees');
Route::post('agregarTorneo', 'TorneoController@store')->name('agregarTorneo');
Route::post('eliminarTorneo/{id}', 'TorneoController@delete')->name('eliminarTorneo');
Route::post('actualizarTorneo/{id}', 'TorneoController@update')->name('actualizarTorneo');
/** Arbitros Torneos **/
Route::post('torneo/{id}/agregarArbitros', 'TorneoController@addReferee')->name('arbitroTorneo');

/** Jornada **/
Route::post('agregarJornada', 'JornadaController@store')->name('agregarJornada');
Route::post('eliminarJornada/{id}', 'JornadaController@delete')->name('eliminarJornada');
Route::post('actualizarJornada/{id}', 'JornadaController@update')->name('actualizarJornada');
/** Añadiendo equipos para las jornadas **/
Route::post('jornada/{id}/equipo', 'JornadaController@addTeam')->name('equipoJornada');
/** Ver todas las jornadas del torneo **/
Route::get('torneo/{idTorneo}/jornada/partido', 'JornadaController@viewAllMatches');
/** Ver Jornada especifica **/
Route::get('torneo/{idTorneo}/jornada/{idJornada}/partido', 'JornadaController@viewMatches');

/** Equipos **/
Route::post('torneo/{id}/agregarEquipo', 'EquipoController@store')->name('agregarEquipo');
Route::post('eliminarEquipo/{id}', 'EquipoController@delete')->name('eliminarEquipo');
Route::post('actualizarEquipo/{id}', 'EquipoController@update')->name('actualizarEquipo');
Route::get('verEquipo/{id}', 'EquipoController@viewTeam')->name('verEquipo');

/** Arbitros **/
Route::get('arbitros/todos', 'ArbitroController@all')->name('todosArbitro');
Route::post('agregarArbitro', 'ArbitroController@store')->name('agregarArbitro');
Route::post('eliminarArbitro/{id}', 'ArbitroController@delete')->name('eliminarArbitro');
Route::post('actualizarArbitro/{id}', 'ArbitroController@update')->name('actualizarArbitro');

/** Jugadores **/
Route::get('jugadores/todos', 'JugadorController@all')->name('todosJugador');
Route::post('agregarJugador', 'JugadorController@store')->name('agregarJugador');
Route::post('eliminarJugador/{id}', 'JugadorController@delete')->name('eliminarJugador');
Route::post('actualizarJugador/{id}', 'JugadorController@update')->name('actualizarJugador');
/** Estadisticas general de Jugador **/
Route::post('jugador/{idJugador}/equipo/{idEquipo}/gol', 'JugadorController@gol')->name('jugadorGol');
Route::post('jugador/{idJugador}/equipo/{idEquipo}/falta', 'JugadorController@falta')->name('jugadorFalta');
Route::post('jugador/{idJugador}/equipo/{idEquipo}/amonestacion', 'JugadorController@amonestacion')->name('jugadorAmonestacion');
Route::post('jugador/{idJugador}/equipo/{idEquipo}/expulsion', 'JugadorController@expulsion')->name('jugadorExpulsion');

/** Responsables **/
Route::get('responsables/todos', 'ResponsableController@all')->name('todosResponsables');
Route::get('responsables/torneo', 'ResponsableController@tournament')->name('torneoResponsables');
Route::get('responsable/{id}/torneos', 'ResponsableController@tournamentLeader');
Route::post('agregarResponsable', 'ResponsableController@store')->name('agregarResponsable');
Route::post('eliminarResponsable/{id}', 'ResponsableController@delete')->name('eliminarResponsable');
Route::post('actualizarResponsable/{id}', 'ResponsableController@update')->name('actualizarResponsable');

/** Partidos **/
Route::post('partidos/{torneoId}/crearPartidos', 'PartidoController@createPlayRoles');