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
Route::post('agregarArbitro', 'ArbitroController@store')->name('agregarArbitro');

/** Jugadores **/
Route::post('agregarJugador', 'JugadorController@store')->name('agregarJugador');

/** Responsables **/
Route::post('agregarResponsable', 'ResponsableController@store')->name('agregarResponsable');
