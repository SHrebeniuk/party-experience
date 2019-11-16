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

	// Team
	Route::get('/teams', 'TeamController@index');
	Route::get('/my-teams', 'TeamController@userTeams')->name('my-teams');
	Route::view('/teams/create', 'admin.team.create');
	Route::get('/teams/{id}', 'TeamController@show');
	Route::get('/teams/show/{title}', 'TeamController@showSingle')->name('show-team')->middleware('user_exist');

	// Profile
	Route::get('/profile', 'UserController@edit')->name('profile');
	Route::patch('profile/update', 'UserController@update')->name('update-profile');
	Route::post('profile/photo', 'UserController@updatePhoto')->name('update-photo');

	// Questions
	Route::get('/questions', 'QuestionsController@index');
	Route::get('/questions/create', 'QuestionsController@create');
	Route::get('/questions/{id}', 'QuestionsController@show');
});

Route::group(['middleware' => ['auth', 'is_admin']], function () {
	Route::get('/admin', 'AdminController@show');

	// Team
	Route::get('/admin/teams', 'Admin\TeamController@index');

	// Categories
	Route::get('/admin/categories', 'QuestionCategoriesController@index');
	Route::get('/admin/categories/create', 'QuestionCategoriesController@create');
	Route::get('/admin/categories/{id}', 'QuestionCategoriesController@show');
});
