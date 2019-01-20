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


// Route::group(['middleware' => ['verified','auth']], function() {
Route::group(['middleware' => ['auth']], function() {

	Route::get('/home', 'HomeController@index')->name('home');
	Route::get('/account', 'AccountController@index')->name('account');
	Route::patch('/account/update', 'AccountController@update')->name('account.update');
    
    //User Manajement
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');

    // Kas Manajement
	Route::prefix('kas')->group(function () {
	    Route::get('/','KeuanganController@kas')->name('kas');
	    Route::get('edit','KeuanganController@editKas')->name('kas.edit');
	    Route::patch('update','KeuanganController@updateKas')->name('kas.update');
    });

	// Keuangan Manajement
	Route::prefix('keuangan')->group(function () {
	    Route::get('/','KeuanganController@keuangan')->name('keuangan');
	    Route::get('create','KeuanganController@createKeuangan')->name('keuangan.create');
	    Route::get('{id}/edit','KeuanganController@editKeuangan')->name('keuangan.edit');

	    Route::delete('{id}/destroy','KeuanganController@destroyKeuangan')->name('keuangan.destroy');
	    Route::post('store','KeuanganController@storeKeuangan')->name('keuangan.store');
	    Route::patch('{id}/update','KeuanganController@updateKeuangan')->name('keuangan.update');
    });
    
    // Challennge Manajement
    Route::resource('challenge','ChallengeController');
	Route::get('challenge/{id}/destroyFile/{file}','ChallengeController@destroyFile')->name('challenge.deleteFile');
	Route::post('challenge/{id}/flag','ChallengeLogController@cekFlag')->name('challenge.cekFlag')->middleware('throttle:10,1');

	// ScoreBoard
	Route::get('score','ScoreBoardController@index')->name('score');
});