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

Route::get('/contato', function () {
	return 'TESTANDO ROTA';
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
