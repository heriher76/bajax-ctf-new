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

Auth::routes(['verify' => true]);
// Auth::routes();


Route::group(['middleware' => ['verified','auth']], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/account', 'AccountController@index')->name('account');
	Route::patch('/account/update', 'AccountController@update')->name('account.update');
    
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
});