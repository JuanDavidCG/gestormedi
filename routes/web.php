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
    return view('auth/login');
    //return view('contenido/contenido');


});


Route::auth();
Route::get('/home/medicamento','MedicamentosController@index');
Route::post('/home/medicamento/registrar','MedicamentosController@store');
Route::put('/home/medicamento/actualizar','MedicamentosController@update');
Route::put('/home/medicamento/desactivar','MedicamentosController@desactivar');
Route::put('/home/medicamento/activar','MedicamentosController@activar');



Route::get('/home', 'HomeController@index');
