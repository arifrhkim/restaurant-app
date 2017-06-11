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

Auth::routes();

Route::get('/home', 'HomeController@index');

# User
Route::get('/user/create', 'UserController@create');
Route::post('/user/store', 'UserController@store');
Route::get('/user/{id}/show', 'UserController@show');
Route::get('/user/{id}/edit', 'UserController@edit');
Route::put('/user/{id}', 'UserController@update');
Route::get('/user/{id}/delete', 'UserController@destroy');

# Search
Route::get('query', 'SearchController@search');
Route::get('query-food', 'SearchController@food');

# Food
Route::get('/food', 'FoodController@index');
Route::get('/food/create', 'FoodController@create');
Route::post('/food/store', 'FoodController@store');
Route::get('/food/{id}/show', 'FoodController@show');
Route::get('/food/{id}/edit', 'FoodController@edit');
Route::put('/food/{id}', 'FoodController@update');
Route::get('/food/{id}/delete', 'FoodController@destroy');
