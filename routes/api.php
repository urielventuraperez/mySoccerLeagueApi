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

/** Arbitros **/
Route::get('arbitros/todos', 'ArbitroController@all')->name('todosArbitro');
Route::post('agregarArbitro', 'ArbitroController@store')->name('agregarArbitro');
Route::post('eliminarArbitro', 'ArbitroController@delete')->name('eliminarArbitro');

/** Jugadores **/
Route::get('jugadores/todos', 'JugadorController@all')->name('todosJugador');
Route::post('agregarJugador', 'JugadorController@store')->name('agregarJugador');
Route::post('eliminarJugador', 'JugadorController@delete')->name('eliminarJugador');

/** Responsables **/
Route::get('responsables/todos', 'ResponsableController@all')->name('todosResponsables');
Route::post('agregarResponsable', 'ResponsableController@store')->name('agregarResponsable');
Route::post('eliminarResponsable', 'ResponsableController@delete')->name('eliminarResponsable');
