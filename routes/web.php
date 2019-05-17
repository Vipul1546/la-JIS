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


Route::resource('/admin/posts', 'PostController', [
	  			'middleware' => ['auth'],
	  			'uses' => function () {
	   				echo "You are allowed to view this page!";
					}]);

Route::resource('/admin/taxonomies', 'TaxonomyController', [
	  			'middleware' => ['auth'],
	  			'uses' => function () {
	   				echo "You are allowed to view this page!";
					}]);

Route::get('/admin/taxonomies/{post_type}/{type}', ['as' => 'indexx','middleware' => ['auth'], 'uses' => 'TaxonomyController@indexx']);

Auth::routes();


Route::get('/admin', 'HomeController@index')->name('home');

Route::resource('/admin/users', 'UserController', ['middleware' => ['auth']]);
