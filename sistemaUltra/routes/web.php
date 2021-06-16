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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});

