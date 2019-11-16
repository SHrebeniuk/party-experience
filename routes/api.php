<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1/')->group(function () {

	Route::post('login', 'Api\AuthController@login');
	Route::post('register', 'Api\AuthController@register');
	Route::post('login-web', 'Auth\LoginController@login');

	// Auth
	Route::group(['middleware' => 'auth:api'], function(){
		Route::post('/images/{type}', 'Api\ImageController@upload');

		// User
		Route::put('/users/{id}', 'Api\UserController@update');
		Route::put('/users/{id}/remove', 'Api\UserController@removeUser');

		// Team
		Route::post('/teams', 'Api\TeamController@create');
		Route::put('/teams/{id}', 'Api\TeamController@update');
		Route::put('/teams/{id}/join/{type}', 'Api\TeamController@join');
		Route::put('/teams/{id}/member/{member_id}/{type}', 'Api\TeamController@updateMember');

		// Category
		Route::get('/categories', 'Api\QuestionCategoriesController@index');
		Route::post('/categories', 'Api\QuestionCategoriesController@create');
		Route::put('/categories/{id}', 'Api\QuestionCategoriesController@update');
		Route::delete('/categories/{id}', 'Api\QuestionCategoriesController@destroy');

		// Question
		Route::post('/questions', 'Api\QuestionController@create');
		Route::put('/questions/{id}', 'Api\QuestionController@update');
		Route::delete('/questions/{id}', 'Api\QuestionController@destroy');

		// Answers
		Route::post('/answers', 'Api\AnswerController@create');

	});
});