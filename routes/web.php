<?php

Route::group(
    [
        'prefix' => \LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ],
    function() {
        Route::get('/', 'HomeController@index')->name('home');

        Route::get('contacts','Homecontroller@contacts')->name('contacts');

        Route::get('/admin/users', 'AdminController@index')->name('admin.users');
        Route::post('/admin/user/transactions/{user}','AdminController@transactions')->name('admin.user.transactions');
        Route::post('/admin/promote/{user}', 'AdminController@promote')->name('admin.promote');
        Route::post('/admin/demote/{user}', 'AdminController@demote')->name('admin.demote');
        Route::post('/admin/user/delete/{user}', 'AdminController@deleteUser')->name('admin.users.delete');
        Route::get('/admin/products', 'AdminController@products')->name('admin.products');
        Route::post('/admin/product/delete/{product}', 'AdminController@deleteProduct')->name('admin.products.delete');
        Route::get('/admin/product/{product}', 'AdminController@show')->name('admin.product.show');
        Route::get('/admin/create', 'AdminController@createProduct')->name('admin.product.create');
        Route::post('/admin/store', 'AdminController@store')->name('admin.store');
        Route::post('/admin/product/comment/delete/{id}','AdminController@delete')->name('admin.comment.delete');
        Route::post('/admin/user/transaction/complete/{id}','AdminController@completeTransaction')->name('admin.transaction.complete');

        Route::get('/user/change', 'UserController@index')->name('user.change');
        Route::post('/user/change/password', 'UserController@reset')->name('user.change.password');

        Route::get('/search', 'HomeController@find')->name('search');

        Route::get('/registration', 'RegistrationController@index')->name('registration.index');
        Route::post('/registration', 'RegistrationController@store')->name('registration.store');
        Route::get('/registration/verify/{token}', 'RegistrationController@verify')->name('registration.verify');

        Route::get('/login', 'LoginController@index')->name('login');
        Route::post('/login', 'LoginController@create')->name('login.create');
        Route::get('/logout', 'LoginController@logout')->name('logout');

        Route::get('/products', 'ProductsController@index')->name('products');
        Route::get('/product/{product}', 'ProductsController@show')->name('product.show');
        Route::get('/product/category/{category}', 'ProductsController@filterByType')->name('product.category');
        Route::get('/products/favourite', 'ProductsController@filterByVisit')->name('product.favourite');
        Route::post('/product/create/comment/{id}','CommentController@store')->name('comment.create');
        Route::post('/product/comment/delete/{id}','CommentController@delete')->name('comment.delete');
        Route::post('/products/price-up','ProductsController@priceUp')->name('product.price.up');
        Route::post('/products/price-down','ProductsController@priceDown')->name('product.price.down');

        Route::post('/rate/{id}','RatingController@store')->name('rating');
        Route::post('/rate/delete/{product}','RatingController@delete')->name('rating.delete');

        Route::get('/cart', 'CartController@index')->name('cart');
        Route::post('/cart/{id}', 'CartController@store')->name('cart.add');
        Route::post('/cart/select/payment/{total}', 'CartController@selectPayment')->name('cart.select.payment');
        Route::post('/cart/delete/item/{id}', 'CartController@deleteOne')->name('cart.delete');
        Route::post('/cart/delete/items', 'CartController@deleteAll')->name('cart.delete.all');
        Route::post('/cart/quantity/plus/{id}', 'CartController@plus')->name('cart.plus');
        Route::post('/cart/quantity/minus/{id}', 'CartController@minus')->name('cart.minus');
        Route::post('/cart/card/{total}', 'CartController@card')->name('cart.card');
        Route::post('/checkout/card', 'CartController@checkout')->name('card.checkout');
        Route::post('/cart/cashondelivery/{total}', 'CartController@cashOnDelivery')->name('cart.dobierka');
        Route::post('/checkout/cashondelivery', 'CartController@cashOnDeliveryCheckout')->name('cart.dobierka.checkout');

        Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
        Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
        Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
});




