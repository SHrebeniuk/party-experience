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

Route::view('/', 'layouts.main')->name('main');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login', function () {
	redirect()->route('main');
})->name('login');


Route::group(['middleware' => ['auth', 'verified']], function () {
	Route::get('/profile', 'UserController@edit')->name('profile');

	// team
	Route::get('/teams', 'TeamController@index');
	Route::get('/my-teams', 'TeamController@userTeams')->name('my-teams');
	Route::view('/teams/create', 'admin.team.create');
	Route::get('/teams/{id}', 'TeamController@show');
	Route::get('/teams/show/{title}', 'TeamController@showSingle')->name('show-team')->middleware('user_exist');

	Route::patch('profile/update', 'UserController@update')->name('update-profile');
	Route::post('profile/photo', 'UserController@updatePhoto')->name('update-photo');
});

Route::group(['middleware' => ['auth', 'is_admin']], function () {
	Route::get('/admin', 'AdminController@show');
});
