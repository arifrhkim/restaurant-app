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
  return redirect('/login');
  // return view('welcome');
  // return view('landing');
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
Route::get('/order/{id}/status', 'OrderController@status');
Route::get('/order/{id}/cancel', 'OrderController@cancel');
Route::get('/order/{id}/cancelDtl', 'OrderController@cancelDtl');
Route::get('/order/{id}/statusDetail', 'OrderController@statusDetail');
Route::get('/order/{id}/show', 'OrderController@show');
Route::get('/order/{id}/delete', 'OrderController@destroy');
Route::get('/orderDtl/{id}/delete', 'OrderController@destroyDtl');
Route::get('/order/{id}/print', 'OrderController@getPDF');

# Social Lite
Route::get('auth/{provider}', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\RegisterController@handleProviderCallback');

# Menu
Route::get('/menu', 'MenuController@indexMenu');
Route::get('/cart/store', 'MenuController@storeCart');
Route::get('/cart', 'MenuController@indexCart');
Route::get('/cart/{id}/delete', 'MenuController@destroyCart');
Route::get('/cart/destroy', 'MenuController@removeCart');
Route::post('/cart/storeOrder', 'MenuController@storeOrder');
Route::get('/cart/order', 'MenuController@orderShow');

Route::get('/orderDetail/{id}/show', 'MenuController@showDetail');

# Feedback
Route::post('/feedback/store', 'FeedbackController@store');
