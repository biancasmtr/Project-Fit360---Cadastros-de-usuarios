<?php

Auth::routes();

/* tela de login */
Route::get('/', function () { return view('auth/login'); });

/* Cadastro de empresas - externo*/
Route::get('/empresas/create','EmpresasController@create');
Route::post('/empresasaction','EmpresasController@storeEmpresa');

/* Home - acesso apenas autenticado */
Route::get('/home', 'HomeController@index')->name('home');

/* rotas protegidas de controllers/admin */
Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function () {
    //Route::resource('usuarios', 'UsuariosController');
    Route::get('usuarios/index', 'UsuariosController@index');
    Route::delete('usuarios/destroy/{id}', 'UsuariosController@destroy');
    
    Route::resource('empresas', 'EmpresasController'); 
    Route::delete('empresas/destroy/{id_empresa}', 'EmpresasController@destroy');
});



