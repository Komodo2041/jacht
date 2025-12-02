<?php

use Illuminate\Support\Facades\Route;
 

Route::get('/', "App\Http\Controllers\MainController@page" );

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

Route::get('/jobs', "App\Http\Controllers\JobController@list" );
Route::match(["get", "post"], '/jobs/add', "App\Http\Controllers\JobController@add" );
Route::match(["get", "post"], '/jobs/edit/{id}', "App\Http\Controllers\JobController@edit" );
Route::get('/jobs/delete/{id}', "App\Http\Controllers\JobController@delete" );

Route::get('/types', "App\Http\Controllers\TypesController@list" );
Route::match(["get", "post"], '/types/add', "App\Http\Controllers\TypesController@add" );
Route::match(["get", "post"], '/types/edit/{id}', "App\Http\Controllers\TypesController@edit" );
Route::get('/types/delete/{id}', "App\Http\Controllers\TypesController@delete" );
Route::get( '/types/show/{id}', "App\Http\Controllers\TypesController@show" );

Route::get('/categories', "App\Http\Controllers\EquipmentCategoryController@list" );
Route::match(["get", "post"], '/categories/add', "App\Http\Controllers\EquipmentCategoryController@add" );
Route::match(["get", "post"], '/categories/edit/{id}', "App\Http\Controllers\EquipmentCategoryController@edit" );
Route::get('/categories/delete/{id}', "App\Http\Controllers\EquipmentCategoryController@delete" );