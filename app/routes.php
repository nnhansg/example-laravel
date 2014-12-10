<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::post('admin/users/delete', 'UserController@postDeleteUserById');

Route::post('admin/users/edit/save', 'UserController@postSaveEditUserById');
Route::post('admin/users/edit', 'UserController@postGetUserById');

Route::get('admin/users/check-email-exist', 'UserController@getCheckEmailExist');
Route::post('admin/users/check-email-exist', 'UserController@postCheckEmailExist');

Route::post('admin/users/add', 'UserController@postAdd');
Route::get('admin/users/add', 'UserController@getAdd');

Route::get('admin/users/index', 'UserController@getAll');
Route::get('admin/users', 'UserController@getAll');

Route::post('admin/logout', 'UserController@postLogout');

Route::post('admin/login', 'UserController@postLogin');
Route::get('admin/login', 'UserController@getLogin');

Route::post('admin', 'DashboardController@postDashboardAdmin');
Route::get('admin', 'DashboardController@getDashboardAdmin');

Route::post('admin/dashboard', 'DashboardController@postDashboardAdmin');
Route::get('admin/dashboard', 'DashboardController@getDashboardAdmin');

Route::get('/', 'HomeController@showHome');