<?php

use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ports', "App\Http\Controllers\PortsController@list" );

Route::match(["get", "post"], '/ports/add', "App\Http\Controllers\PortsController@add" );
Route::match(["get", "post"], '/ports/edit/{id}', "App\Http\Controllers\PortsController@edit" );
Route::get('/ports/delete/{id}', "App\Http\Controllers\PortsController@delete" );
