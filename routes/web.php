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

Route::get('/admin/regiones', 'RegionController@index')->name('regiones');
Route::get('/admin/region/{slug?}/mostrar/',   'RegionController@show')  ->name('mostrar.region');
Route::get('/admin/region/{slug?}/editar/',  'RegionController@edit')  ->name('editar.regiones');
Route::put('/admin/region/{slug?}/actualizar/', 'RegionController@update')->name('actualizar.regiones');

/**
 * Niveles Educativos
 */
Route::get(     '/admin/niveles',                   'NivelController@index')    ->name('ver.niveles');
Route::get(     '/admin/crear/nivel/',              'NivelController@create')   ->name('crear.nivel');
Route::post(    '/admin/almacena/nivel/{slug?}',    'NivelController@store')    ->name('almacena.nivel');
Route::get(     '/admin/mostrar/nivel/{slug?}',     'NivelController@show')     ->name('mostrar.nivel');
Route::get(     '/admin/editar/nivel/{slug?}',      'NivelController@edit')     ->name('editar.nivel');
Route::put(     '/admin/actualizar/nivel/{slug?}',  'NivelController@update')   ->name('actualizar.nivel');
Route::delete(  '/admin/eliminar/nivel/{slug?}',    'NivelController@destroy')  ->name('eliminar.nivel');

/**
 * Nomenclaturas Delegacionales
 */
Route::get('/admin/nomenclaturas', 'NomenclaturaController@index')->name('ver.nomenclaturas');
Route::get('/admin/crear/nomenclatura/', 'NomenclaturaController@create')->name('crear.nomenclatura');
Route::post('/admin/almacena/nomenclatura/{slug?}', 'NomenclaturaController@store')->name('almacena.nomenclatura');
Route::get('/admin/mostrar/nomenclatura/{slug?}', 'NomenclaturaController@show')->name('mostrar.nomenclatura');
Route::get('/admin/editar/nomenclatura/{slug?}','NomenclaturaController@edit')->name('editar.nomenclatura');
Route::put('a/admin/ctualizar/nomenclatura/{slug?}', 'NomenclaturaController@update')->name('actualizar.nomenclatura');
Route::delete('/admin/eliminar/nomenclatura/{slug?}', 'NomenclaturaController@destroy')->name('eliminar.nomenclatura');

/**
 * Nomenclaturas Delegacionales
 */
Route::get('/admin/delegaciones', 'DelegacionController@index')->name('ver.delegaciones');
Route::get('/admin/crear/delegacion/', 'DelegacionController@create')->name('crear.delegacion');
Route::post('/admin/almacena/delegacion/{slug?}', 'DelegacionController@store')->name('almacena.delegacion');
Route::get('/admin/mostrar/delegacion/{slug?}', 'DelegacionController@show')->name('mostrar.delegacion');
Route::get('/admin/editar/delegacion/{slug?}','DelegacionController@edit')->name('editar.delegacion');
Route::put('/admin/actualizar/delegacion/{slug?}', 'DelegacionController@update')->name('actualizar.delegacion');
Route::delete('/admin/eliminar/delegacion/{slug?}', 'DelegacionController@destroy')->name('eliminar.delegacion');

/**
 * Nomenclaturas Delegados
 */
Route::get('/admin/delegados', 'DelegadoController@index')->name('ver.delegados');
Route::get('/admin/regiones/{id}/delegaciones','DelegadoController@delegaciones');
Route::get('/admin/crear/delegado/', 'DelegadoController@create')->name('crear.delegado');
Route::post('/admin/almacena/delegado/', 'DelegadoController@store')->name('almacena.delegado');

Route::get('/admin/mostrar/delegado/{slug?}', 'DelegadoController@show')->name('mostrar.delegado');
Route::get('/admin/editar/delegado/{slug?}','DelegadoController@edit')->name('editar.delegado');
Route::put('/admin/actualizar/delegado/{slug?}', 'DelegadoController@update')->name('actualizar.delegado');
Route::delete('/admin/eliminar/delegado/{slug?}', 'DelegadoController@destroy')->name('eliminar.delegado');
Route::get('/admin/exportar/excel/', 'DelegadoController@export')->name('exportar.delegados');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
