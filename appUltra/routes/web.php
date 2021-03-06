<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
})->name('welcome');

//Registro URI
Route::name('registro.index')->get('registro', 'Fase1\Registro\RegistroController@index');
Route::name('registro.store')->post('registro', 'Fase1\Registro\RegistroController@store');
Route::name('registro.show')->get('registro/listado', 'Fase1\Registro\RegistroController@show');
Route::name('registro.update')->post('registro/asignar/comision', 'Fase1\Registro\RegistroController@update');

//Invitacion URI
Route::name('invitacion.accept')->get('invitacion/{friend}/acepta/{token}', 'Fase1\Invitacion\InvitacionController@accept');
Route::name('invitacion.store_accept')->post('invitacion/accept', 'Fase1\Invitacion\InvitacionController@store_accept');
Route::name('invitacion.denies')->get('invitacion/{friend}/rechaza/{token}', 'Fase1\Invitacion\InvitacionController@denies');
