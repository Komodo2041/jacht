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
Route::get('/producer/{id}/models', "App\Http\Controllers\ProducerController@modelList" );
Route::match(["get", "post"], '/producer/{id}/models/add', "App\Http\Controllers\ProducerController@modelAdd" );
Route::match(["get", "post"], '/producer/{id}/models/edit/{modelid}', "App\Http\Controllers\ProducerController@modelEdit" );
Route::get('/producer/{id}/models/delete/{modelid}', "App\Http\Controllers\ProducerController@modelDelete" );

Route::get('/producer/{id}/notes', "App\Http\Controllers\ProducerController@notesList" );
Route::match(["get", "post"], '/producer/{id}/notes/add', "App\Http\Controllers\ProducerController@noteAdd" );
Route::match(["get", "post"], '/producer/{id}/notes/edit/{noteid}', "App\Http\Controllers\ProducerController@noteEdit" );
Route::get('/producer/{id}/notes/delete/{noteid}', "App\Http\Controllers\ProducerController@noteDelete" );

Route::get('/departments', "App\Http\Controllers\DepartmentController@list" );
Route::match(["get", "post"], '/departments/add', "App\Http\Controllers\DepartmentController@add" );
Route::match(["get", "post"], '/departments/edit/{id}', "App\Http\Controllers\DepartmentController@edit" );
Route::get('/departments/delete/{id}', "App\Http\Controllers\DepartmentController@delete" );
