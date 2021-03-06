<?php

declare(strict_types=1);

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('pets', 'PetsController@index')->name('pets');
Route::get('about', 'AboutController@index')->name('about');

Route::middleware('auth')->group(static function (): void {
    Route::get('/admin/{any?}', 'AdminController')
        ->name('admin')
        ->middleware('can:admin')
        ->where('any', '.*');

    Route::get('/user/{any?}', 'UserController')
        ->name('user')
        ->where('any', '.*');

    Route::post('cart', 'CartController@store')->name('cart-store');
});
