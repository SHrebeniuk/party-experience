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

Route::view('/', 'welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
	Route::get('/profile', 'UserController@edit');

	// tema
	Route::get('/teams', 'TeamController@index');
	Route::view('/teams/create', 'admin.team.create');
	Route::get('/teams/{id}', 'TeamController@show');

	Route::patch('profile/update', 'UserController@update')->name('update-profile');
	Route::post('profile/photo', 'UserController@updatePhoto')->name('update-photo');
});

Route::group(['middleware' => ['auth', 'is_admin']], function () {
	Route::get('/admin', 'AdminController@show');
});
