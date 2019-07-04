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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/** Torneos **/
Route::post('agregarTorneo', 'TorneoController@store')->name('agregarTorneo');
Route::post('eliminarTorneo/{id}', 'TorneoController@delete')->name('eliminarTorneo');
Route::post('actualizarTorneo/{id}', 'TorneoController@update')->name('actualizarTorneo');

/** Jornada **/
Route::post('agregarJornada', 'JornadaController@store')->name('agregarJornada');
Route::post('eliminarJornada/{id}', 'JornadaController@delete')->name('eliminarJornada');
Route::post('actualizarJornada/{id}', 'JornadaController@update')->name('actualizarJornada');

/** Equipos **/
Route::post('agregarEquipo', 'EquipoController@store')->name('agregarEquipo');
Route::post('eliminarEquipo/{id}', 'EquipoController@delete')->name('eliminarEquipo');
Route::post('actualizarEquipo/{id}', 'EquipoController@update')->name('actualizarEquipo');

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

/** Responsables **/
Route::get('responsables/todos', 'ResponsableController@all')->name('todosResponsables');
Route::post('agregarResponsable', 'ResponsableController@store')->name('agregarResponsable');
Route::post('eliminarResponsable/{id}', 'ResponsableController@delete')->name('eliminarResponsable');
Route::post('actualizarResponsable/{id}', 'ResponsableController@update')->name('actualizarResponsable');