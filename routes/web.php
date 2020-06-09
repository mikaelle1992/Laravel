<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/imoveis','PropertyController@index');
//"imoveis "=> rota 

Route::get('/imoveis/novo','PropertyController@create');
Route::post('/imoveis/store','PropertyController@store');

Route::get('/imoveis/{name}','PropertyController@show');


Route::get('/imoveis/editar/{name}','PropertyController@edit');
Route::put('/imoveis/update/{name}','PropertyController@update');


Route::get('/imoveis/remover/{name}','PropertyController@destroy');


