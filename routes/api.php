<?php

use App\Enums\UserRoleEnum;
use Illuminate\Support\Facades\Route;

/*START AUTH*/

Route::group(['prefix' => 'v1/auth', 'as' => 'api.v1.auth.', 'middleware' => ['api', 'throttle:50,1'],
    'namespace' => 'App\Http\Controllers\Api\V1\Auth'], function () {

    Route::post('register', 'AuthController@register')
        ->name('register');

    Route::post('login', 'AuthController@login')
        ->name('login');

    Route::post('logout', 'AuthController@logout')
        ->name('logout')->middleware('auth:sanctum');

});

/*END AUTH*/

/*START ADMIN*/

Route::group(['prefix' => 'v1/admin', 'as' => 'api.v1.admin.',
    'middleware' => ['api', 'throttle:50,1', 'auth:sanctum',
        'check_role:' . UserRoleEnum::ADMIN->value],
    'namespace' => 'App\Http\Controllers\Api\V1\Admin'], function () {

    Route::apiResource('properties', 'PropertyController');

    Route::apiResource('products', 'ProductController')
        ->except('update');

    Route::post('products/{product}', 'ProductController@update')
        ->name('products.update');

    Route::post('products/properties/save/{product}', 'ProductController@save_properties')
        ->name('products.properties.save');

});

/*END ADMIN*/