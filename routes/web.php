<?php

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

/* 
Route::get('/', function () {
    return view('welcome');
});
 */

Route::get('/', 'RegionController@index')->name('regiones');
Route::get('regiones/{slug?}/mostrar/',   'RegionController@show')  ->name('mostrar.regiones');
Route::get('regiones/{slug?}/editar/',  'RegionController@edit')  ->name('editar.regiones');
Route::put('actualizar/{slug?}/actualizar/', 'RegionController@update')->name('actualizar.regiones');

/**
 * Niveles Educativos
 */
Route::get('/niveles', 'NivelController@index')->name('ver.niveles');
Route::get('crear/nivel/', 'NivelController@create')->name('crear.nivel');
Route::post('almacena/nivel/{slug?}', 'NivelController@store')->name('almacena.nivel');
Route::get('mostrar/nivel/{slug?}', 'NivelController@show')->name('mostrar.nivel');
Route::get('editar/nivel/{slug?}','NivelController@edit')->name('editar.nivel');
Route::put('actualizar/nivel/{slug?}', 'NivelController@update')->name('actualizar.nivel');
Route::delete('eliminar/nivel/{slug?}', 'NivelController@destroy')->name('eliminar.nivel');

/**
 * Nomenclaturas Delegacionales
 */
Route::get('/nomenclaturas', 'NomenclaturaController@index')->name('ver.nomenclaturas');
Route::get('crear/nomenclatura/', 'NomenclaturaController@create')->name('crear.nomenclatura');
Route::post('almacena/nomenclatura/{slug?}', 'NomenclaturaController@store')->name('almacena.nomenclatura');
Route::get('mostrar/nomenclatura/{slug?}', 'NomenclaturaController@show')->name('mostrar.nomenclatura');
Route::get('editar/nomenclatura/{slug?}','NomenclaturaController@edit')->name('editar.nomenclatura');
Route::put('actualizar/nomenclatura/{slug?}', 'NomenclaturaController@update')->name('actualizar.nomenclatura');
Route::delete('eliminar/nomenclatura/{slug?}', 'NomenclaturaController@destroy')->name('eliminar.nomenclatura');

/**
 * Nomenclaturas Delegacionales
 */
Route::get('/delegaciones', 'DelegacionController@index')->name('ver.delegaciones');
Route::get('crear/delegacion/', 'DelegacionController@create')->name('crear.delegacion');
Route::post('almacena/delegacion/{slug?}', 'DelegacionController@store')->name('almacena.delegacion');
Route::get('mostrar/delegacion/{slug?}', 'DelegacionController@show')->name('mostrar.delegacion');
Route::get('editar/delegacion/{slug?}','DelegacionController@edit')->name('editar.delegacion');
Route::put('actualizar/delegacion/{slug?}', 'DelegacionController@update')->name('actualizar.delegacion');
Route::delete('eliminar/delegacion/{slug?}', 'DelegacionController@destroy')->name('eliminar.delegacion');

/**
 * Nomenclaturas Delegados
 */
Route::get('/delegados', 'DelegadoController@index')->name('ver.delegados');
Route::get('/regiones/{id}/delegaciones','DelegadoController@delegaciones');
Route::get('crear/delegado/', 'DelegadoController@create')->name('crear.delegado');
Route::post('almacena/delegado/', 'DelegadoController@store')->name('almacena.delegado');

Route::get('mostrar/delegado/{slug?}', 'DelegadoController@show')->name('mostrar.delegado');
Route::get('editar/delegado/{slug?}','DelegadoController@edit')->name('editar.delegado');
Route::put('actualizar/delegado/{slug?}', 'DelegadoController@update')->name('actualizar.delegado');
Route::delete('eliminar/delegado/{slug?}', 'DelegadoController@destroy')->name('eliminar.delegado');
Route::get('exportar/excel/', 'DelegadoController@export')->name('exportar.delegados');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
