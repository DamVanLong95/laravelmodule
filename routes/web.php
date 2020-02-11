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
Route::get('login',function(){
	return view('login');
});
Route::post('logins','UserController@login')->name('user.login');
Route::get('danhsach',function(){
	return view('employees.list');
});
// Route::get('datatables','DatatablesController@getIndex')->name('datatables.data');
// Route::post('datatables/{id}','DatatablesController@destroy')->name('datatables.destroy');
// Route::get('datatables/create','DatatablesController@create')->name('datatables.create');
// Route::post('/datatables/create','DatatablesController@store')->name('datatables.store');
Route::resource('datatables','DatatablesController');