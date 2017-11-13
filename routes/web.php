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

Route::get('/', function () {
   return view('welcome');
//return 'pagina inicial';
});

    Route::any('/painel/partidos/pesquisar', 'Painel\PartidoController@search')->name('partidos.search');    
    Route::resource('/painel/partidos', 'Painel\PartidoController');	
	Route::any('/painel/paises/pesquisar', 'Painel\PaisController@search')->name('paises.search');
    Route::resource('/painel/paises', 'Painel\PaisController');



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
