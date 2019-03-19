<?php

declare(strict_types=1);

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('user', static function (Request $request) {
    return $request->user();
});

Route::group(
    [
        'namespace' => 'Api',
        'middleware' => 'auth:api',
    ],
    static function (): void {
        Route::get('categories', 'CategoryController@index');
        Route::get('pets', 'PetsController@index');
        Route::get('cart', 'CartController@index');

        Route::post('categories', 'CategoryController@store');
        Route::post('pets', 'PetsController@store');
        Route::post('images', 'ImageController@store');
        Route::post('cart', 'CartController@store');

        Route::put('categories/{category}', 'CategoryController@update');
        Route::put('pets/{pet}', 'PetsController@update');
        Route::patch('cart/{item}', 'CartController@update');

        Route::delete('categories/{category}', 'CategoryController@destroy');
        Route::delete('pets/{pet}', 'PetsController@destroy');
        Route::delete('images/{file}', 'ImageController@destroy');
        Route::delete('cart/{item}', 'CartController@destroy');
    }
);
