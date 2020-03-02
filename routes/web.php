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
Route::post('carstore','CarController@store');
Route::get('caredit','CarController@edit');
Route::post('carupdate','CarController@update');
Route::get('cardelete','CarController@delete');

//預設驗證功能
//Auth::routes();
//啟用 Email 驗證功能
//Auth::routes(['verify'=>true]);
//取消註冊功能
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');