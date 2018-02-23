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
Route::group(
    [
        'prefix' => \LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('/admin', 'AdminController@show')->name('admin');
        Route::get('/admin/users', 'AdminController@index')->name('admin.users');
        Route::post('/admin/user/delete/{user}', 'AdminController@deleteUser')->name('admin.users.delete');
        Route::get('/admin/products', 'AdminController@products')->name('admin.products');
        Route::post('/admin/product/delete/{product}', 'AdminController@deleteProduct')->name('admin.products.delete');
        Route::get('/admin/create', 'AdminController@create')->name('admin.create');
        Route::post('/admin/store', 'AdminController@store')->name('admin.store');

        Route::get('/user/change', 'UserController@index');
        Route::post('/user/change', 'UserController@reset')->name('change.password');

        Route::get('/search', 'HomeController@find')->name('search');

        Route::get('/registration', 'RegistrationController@index')->name('registration.index');
        Route::post('/registration', 'RegistrationController@store')->name('registration.store');

        Route::get('/login', 'LoginController@index')->name('login');
        Route::post('/login', 'LoginController@create')->name('login.create');
        Route::get('/logout', 'LoginController@logout')->name('logout');

        Route::get('/products', 'ProductsController@index')->name('products');
        Route::get('/product/{product}', 'ProductsController@show')->name('product.show');
        Route::get('/product/type/{type}', 'ProductsController@filter')->name('product.type');
        Route::post('/product/create/comment/{product}','CommentController@store')->name('comment.create');

        Route::get('/cart', 'CartController@index')->name('cart');
        Route::post('/cart/{id}', 'CartController@store')->name('cart.add');
        Route::post('/cart/delete/item/{id}', 'CartController@deleteOne')->name('cart.delete');
        Route::post('/cart/delete/items', 'CartController@deleteAll')->name('cart.delete.all');
        Route::post('/cart/quantity/plus/{id}', 'CartController@plus')->name('cart.plus');
        Route::post('/cart/quantity/minus/{id}', 'CartController@minus')->name('cart.minus');
        Route::post('/cart/payment/{total}', 'CartController@card')->name('cart.card');
        Route::post('/checkout', 'CartController@checkout')->name('cart.checkout');

        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

        Route::get('/language/{locale}', 'LanguageController@language')->name('language');
    });




