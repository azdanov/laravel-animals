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

        Route::post('categories', 'CategoryController@store');
        Route::post('image', 'ImageController@store');

        Route::delete('categories/{category}', 'CategoryController@destroy');
        Route::delete('pets/{pet}', 'PetsController@destroy');
        Route::delete('image/{file}', 'ImageController@destroy');
    }
);
