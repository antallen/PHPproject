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
});

//Route::resource('customer', 'CustomerController');
Route::get('customer','CustomerController@index');
Route::get('new','CustomerController@new');
Route::post('store','CustomerController@store');
Route::get('edit','CustomerController@edit');
Route::post('update','CustomerController@update');
Route::get('delete','CustomerController@delete');
Route::get('car','CarController@index');
Route::get('carnew','CarController@new');
Route::post('carstore','CustomerController@store');