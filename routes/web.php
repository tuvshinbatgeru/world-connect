<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin', function () {
	return view('admin.index');
});

Route::group(['prefix' => '/admin'], function () {
	Route::get('/dashboard', 'AdminController@dashboard');
	Route::get('/country/list', 'CountryController@list');
	Route::get('/country/check', 'CountryController@check');
	Route::resource('/country', 'CountryController');
	Route::post('/upload', 'AdminController@upload');
	Route::delete('/delete', 'AdminController@delete');
});
