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
Route::get('/user', 'UserController@index');
Route::get('/user/create', function () {
    return view('/admin/create');
});
Route::post('/user/store', 'UserController@store');
Route::get('/user/{id}/show', 'UserController@show');
Route::get('/user/{id}/edit', 'UserController@edit');
Route::put('/user/{id}', 'UserController@update');
Route::get('/user/{id}/delete', 'UserController@destroy');
Route::get('/user/{id}/setting', function () {
    return view('/admin/setting');
});
Route::put('/user/{id}/change', 'UserController@updatePassword');
Route::get('/user/{id}/profile', 'UserController@showProfile');
Route::post('profile', 'UserController@updateAvatar');

Route::get('/customers', 'UserController@customers');

# Search
Route::get('query', 'SearchController@search');
Route::get('query-food', 'SearchController@food');

# Food
Route::get('/food', 'FoodController@index');
Route::get('/food/create', function () {
    return view ('/food/create');
});
Route::post('/food/store', 'FoodController@store');
Route::get('/food/{id}/show', 'FoodController@show');
Route::get('/food/{id}/edit', 'FoodController@edit');
Route::put('/food/{id}', 'FoodController@update');
Route::get('/food/{id}/delete', 'FoodController@destroy');

# Order
Route::get('/order', 'OrderController@index');
Route::get('/order/create', 'OrderController@create');
// Route::get('/order/create', function () {
//     return view ('/order/create');
// });
Route::post('/order/store', 'OrderController@store');
// Route::get('/order/{id}/addCart', 'OrderController@addCart');
Route::get('/order/{id}/show', 'OrderController@show');

# Social Lite
Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');
