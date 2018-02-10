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

Route::get('/', 'HomerController@index')->name('home');

Route::get('/admin','AdminController@index');

Route::get('/search', 'HomerController@find');

Route::get('/registration', 'RegistrationController@index');
Route::post('/registration', 'RegistrationController@store');

Route::get('/login', 'LoginController@index')->name('login');
Route::post('/login', 'LoginController@create');
Route::get('/logout', 'LoginController@logout');

Route::get('/products', 'ProductsController@index');
Route::get('/product/{product}', 'ProductsController@show');
Route::get('/type={type}', 'ProductsController@filter');//neni dokoncene
// neni dokonceny cely odstavec
Route::get('/cart','CartController@index');
Route::post('/cart','CartController@store');

//neni dokonceny cely odstavec ale pride aj na to
Route::get('/password/reset','Auth/ForgotPasswordController@showLinkRequestForm');
Route::post('/password/email','Auth/ForgotPasswordController@sendResetLinkEmail');
Route::get('/password/reset/{token}','Auth/ResetPasswordController@showResetForm');
Route::post('/password/reset','Auth/ResetPasswordController@reset');

//Route::post('/sk','LanguageController@slovak');//nefunguje
//Route::post('/en','LanguageController@english');//nefunguje



//Route::post('/?description={{ $product->description }}', 'ProductsController@filterByDescription');

