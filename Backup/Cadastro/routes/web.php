<?php

use App\User;
use App\Empresa;
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
    Route::resource('usuarios', 'UsuariosController');
    Route::resource('empresas', 'EmpresasController'); 
    Route::get('empresas/index', 'EmpresasController@index'); 
    Route::put('empresas/update/{id_empresa}', 'EmpresasController@update'); 
    Route::delete('empresas/destroy/{id_empresa}', 'EmpresasController@destroy');
});

