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
