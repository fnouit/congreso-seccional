<?php


Route::middleware(['guest'])->group(function(){
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/login', 'Auth\LoginController@showLoginForm');
    Route::post('/login', 'Auth\LoginController@loginRegistro')->name('login');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

    /**
     * Ruta Principal de inicio de sesion
     */
    Route::get('/admin', function (){ return view ('admin.index'); })->name('admin');


    Route::group(['middleware' => ['admin']], function () {
        /**
         * Regiones
         */
        Route::get('admin/regiones', 'RegionController@index')->name('regiones');
        Route::post('admin/region/registrar',   'RegionController@store');
        Route::put('admin/region/actualizar/', 'RegionController@update');
        Route::delete('admin/region/eliminar/{id}', 'RegionController@destroy');
        
        /**
         * Niveles Educativos
         */
        Route::get('admin/niveles', 'NivelController@index')->name('niveles');
        Route::post('admin/nivel/registrar/',   'NivelController@store');
        Route::put('admin/nivel/actualizar/', 'NivelController@update');
        Route::delete('admin/nivel/eliminar/{id}', 'NivelController@destroy');
    
        /**
         * Nomenclaturas 
         */
        Route::get('admin/nomenclaturas', 'NomenclaturaController@index')->name('nomenclaturas');
        Route::post('admin/nomenclatura/registrar/',   'NomenclaturaController@store');
        Route::put('admin/nomenclatura/actualizar/', 'NomenclaturaController@update');
        Route::delete('admin/nomenclatura/eliminar/{id}', 'NomenclaturaController@destroy');
    
        /**
         * Delegacionales
         */
        Route::get('admin/delegaciones', 'DelegacionController@index')->name('delegaciones');
        Route::post('admin/delegacion/registrar',   'DelegacionController@store');
        Route::put('admin/delegacion/actualizar/', 'DelegacionController@update');
        Route::delete('admin/delegacion/eliminar/{id}', 'DelegacionController@destroy');    
    
        /**
         * Delegados
         */
        Route::get('admin/delegados', 'DelegadoController@index')->name('delegados');
        Route::post('admin/delegado/registrar',   'DelegadoController@store');
        Route::put('admin/delegado/actualizar/', 'DelegadoController@update');
        Route::delete('admin/delegado/eliminar/{id}', 'DelegadoController@destroy');
        Route::get('admin/delegados/arrayGeneros', 'DelegadoController@arrayGeneros');
        Route::get('admin/delegados/arrayEstudios', 'DelegadoController@arrayEstudios');
        Route::get('admin/delegados/arrayEcivil', 'DelegadoController@arrayEcivil');
        Route::get('admin/delegados/arrayDelegaciones/{id}', 'DelegadoController@arrayDelegaciones');
        Route::get('admin/delegados/arrayRegiones', 'DelegadoController@arrayRegiones');
        Route::get('admin/exportar/excel/', 'DelegadoController@export')->name('exportar.delegados');
    
        Route::get('admin/roles', 'RolController@index');    
    });


    Route::group(['middleware' => ['visualizador']], function () {
        Route::get('admin/regiones', 'RegionController@index')->name('regiones');
        Route::get('admin/delegaciones', 'DelegacionController@index')->name('delegaciones');
        Route::get('admin/delegados', 'DelegadoController@index')->name('delegados');
    });


    Route::group(['middleware' => ['capturador']], function () {
        /**
         * Delegados
         */
        Route::get('admin/delegados', 'DelegadoController@index')->name('delegados');
        Route::post('admin/delegado/registrar',   'DelegadoController@store');
        Route::put('admin/delegado/actualizar/', 'DelegadoController@update');
        Route::get('admin/delegados/arrayGeneros', 'DelegadoController@arrayGeneros');
        Route::get('admin/delegados/arrayEstudios', 'DelegadoController@arrayEstudios');
        Route::get('admin/delegados/arrayEcivil', 'DelegadoController@arrayEcivil');
        Route::get('admin/delegados/arrayDelegaciones/{id}', 'DelegadoController@arrayDelegaciones');
        Route::get('admin/delegados/arrayRegiones', 'DelegadoController@arrayRegiones');
    });    
});