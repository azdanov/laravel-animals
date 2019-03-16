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
        Route::get('categories', 'CategoryApiController@index');
        Route::get('pets', 'PetsApiController@index');

        Route::delete('categories/{category}', 'CategoryApiController@destroy');
        Route::delete('pets/{pet}', 'PetsApiController@destroy');
    }
);
