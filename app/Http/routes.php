<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'roles'], 'roles' => 'Admin'], function () {
	
	Route::get('/', 'Admin\\AdminController@index');
	Route::resource('/users', 'Admin\\UsersController');
	Route::get('/give-role-permissions', 'Admin\\AdminController@getGiveRolePermissions');
	Route::post('/give-role-permissions', 'Admin\\AdminController@postGiveRolePermissions');
	Route::resource('/roles', 'Admin\\RolesController');
	Route::resource('/permissions', 'Admin\\PermissionsController');
	Route::get('/generator', 'Admin\\ProcessController@postGenerator');
});
Route::post('/articles/{id}/comment','CommentsController@postComment');
Route::resource('articles','ArticlesController');


Route::auth();
Route::get('/home', 'HomeController@index');
 