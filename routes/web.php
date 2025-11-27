<?php

use Illuminate\Support\Facades\Route;
 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ports', "App\Http\Controllers\PortsController@list" );
Route::match(["get", "post"], '/ports/add', "App\Http\Controllers\PortsController@add" );
Route::match(["get", "post"], '/ports/edit/{id}', "App\Http\Controllers\PortsController@edit" );
Route::get('/ports/delete/{id}', "App\Http\Controllers\PortsController@delete" );

Route::get('/producer', "App\Http\Controllers\ProducerController@list" );
Route::match(["get", "post"], '/producer/add', "App\Http\Controllers\ProducerController@add" );
Route::match(["get", "post"], '/producer/edit/{id}', "App\Http\Controllers\ProducerController@edit" );
Route::get('/producer/delete/{id}', "App\Http\Controllers\ProducerController@delete" );
