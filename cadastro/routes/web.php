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

/* Home - acesso apenas autenticado */
Route::get('/home', 'HomeController@index')->name('home');

/* rotas protegidas de controllers/admin */
Route::middleware(['auth'])->prefix('admin')->namespace('Admin')->group(function () {
    Route::resource('usuarios', 'UsuariosController');
    Route::resource('empresas', 'EmpresasController');
    Route::get('empresas/show/{id}', 'EmpresasController@show');
});

/* testando cadastro de empresas*/
Route::get('/empresas','EmpresasController@index');
Route::get('/empresas/create','EmpresasController@create');
Route::post('/empresasaction','EmpresasController@storeEmpresa');
