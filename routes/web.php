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

