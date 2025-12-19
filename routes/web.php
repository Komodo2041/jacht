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
Route::get('/equipments', "App\Http\Controllers\EquipmentController@list" );
Route::match(["get", "post"], '/equipments/add', "App\Http\Controllers\EquipmentController@add" );
Route::match(["get", "post"], '/equipments/edit/{id}', "App\Http\Controllers\EquipmentController@edit" );
Route::get('/equipments/delete/{id}', "App\Http\Controllers\EquipmentController@delete" );
 
Route::get('/yachts', "App\Http\Controllers\YachtsController@list" );
Route::match(["get", "post"], '/yachts/add', "App\Http\Controllers\YachtsController@add" );
Route::match(["get", "post"], '/yachts/edit/{id}', "App\Http\Controllers\YachtsController@edit" );
Route::get('/yachts/delete/{id}', "App\Http\Controllers\YachtsController@delete" );
Route::get('/yachts/show/{id}', "App\Http\Controllers\YachtsController@show" );
Route::match(["get", "post"], '/yachts/changeport/{id}', "App\Http\Controllers\YachtsController@changeport" );
Route::match(["get", "post"], '/yachts/parametrschange/{id}', "App\Http\Controllers\YachtsController@parametrsChange" );
Route::get('/yachts/parameters/{id}', "App\Http\Controllers\YachtsController@parametrs" );
Route::match(["get", "post"], '/yachts/equimpents/{id}', "App\Http\Controllers\YachtsController@equimpents" );
Route::get('/yachts/albums/{id}', "App\Http\Controllers\YachtsController@albums" );
Route::match(["get", "post"], '/yachts/albums/{id}/add', "App\Http\Controllers\YachtsController@album_add" );
Route::match(["get", "post"], '/yachts/albums/{id}/edit/{aid}', "App\Http\Controllers\YachtsController@album_edit" );
Route::get('/yachts/albums/{id}/delete/{aid}', "App\Http\Controllers\YachtsController@album_delete" );
Route::match(["get", "post"], '/yachts/positionconfiguration/{id}', "App\Http\Controllers\YachtsController@positionconfiguration" ); 


Route::get('/parameters', "App\Http\Controllers\ParametersController@list" );
Route::match(["get", "post"], '/parameters/add', "App\Http\Controllers\ParametersController@add" );
Route::match(["get", "post"], '/parameters/edit/{id}', "App\Http\Controllers\ParametersController@edit" );
Route::get('/parameters/delete/{id}', "App\Http\Controllers\ParametersController@delete" );

Route::get('/albums/{id}', "App\Http\Controllers\ImagesController@albums" );
Route::match(["get", "post"], '/albums/{id}/add', "App\Http\Controllers\ImagesController@album_add" );
Route::match(["get", "post"], '/albums/{id}/edit/{aid}', "App\Http\Controllers\ImagesController@album_edit" );
Route::get('/albums/{id}/delete/{fid}', "App\Http\Controllers\ImagesController@album_delete" );

Route::get('/documentstypes', "App\Http\Controllers\DocumentsTypesController@list" );
Route::match(["get", "post"], '/documentstypes/add', "App\Http\Controllers\DocumentsTypesController@add" );
Route::match(["get", "post"], '/documentstypes/edit/{id}', "App\Http\Controllers\DocumentsTypesController@edit" );
Route::get('/documentstypes/delete/{id}', "App\Http\Controllers\DocumentsTypesController@delete" );

Route::get('/{type}/documents/{id}', "App\Http\Controllers\DocumentsController@list" );
Route::match(["get", "post"], '/{type}/documents/{id}/add', "App\Http\Controllers\DocumentsController@add" );
Route::match(["get", "post"], '/{type}/documents/{id}/edit/{did}', "App\Http\Controllers\DocumentsController@edit" );
Route::get('/{type}/documents/{id}/delete/{aid}', "App\Http\Controllers\DocumentsController@delete" );

Route::get('/nationality', "App\Http\Controllers\NationalityController@list" );
Route::match(["get", "post"], '/nationality/add', "App\Http\Controllers\NationalityController@add" );
Route::match(["get", "post"], '/nationality/edit/{id}', "App\Http\Controllers\NationalityController@edit" );
Route::get('/nationality/delete/{id}', "App\Http\Controllers\NationalityController@delete" );

Route::get('/crew', "App\Http\Controllers\CrewController@list" );
Route::match(["get", "post"], '/crew/add', "App\Http\Controllers\CrewController@add" );
Route::match(["get", "post"], '/crew/edit/{id}', "App\Http\Controllers\CrewController@edit" );
Route::get('/crew/delete/{id}', "App\Http\Controllers\CrewController@delete" );
Route::get( '/crew/show/{id}', "App\Http\Controllers\CrewController@show" );
Route::match(["get", "post"], '/crew/changeport/{id}', "App\Http\Controllers\CrewController@changeport" );
 