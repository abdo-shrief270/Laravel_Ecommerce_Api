<?php

use App\Http\Controllers\CategoryController,
    App\Http\Controllers\ProductController,
    App\Http\Controllers\UserController,
    Illuminate\Support\Facades\Route


;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\test;

Route::group(['middleware' => 'api', 'prefix' => 'v1'], function () {
    Route::group(['prefix' => 'user'], function () {
        Route::post('/signIn', [UserController::class, "signIn"]);
        Route::post('/signUp', [UserController::class, "signUp"]);
        Route::post('/editname', [UserController::class, "editName"]);
        Route::post('/editPassword', [UserController::class, "editPassword"]);
        Route::post('/editEmail', [UserController::class, "editEmail"]);
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/all', [ProductController::class, "productsByPage"]);
        Route::get('/search/{term}', [ProductController::class, "searchByName"]);
        Route::get('/{id}/category', [ProductController::class, "productCategoryById"]);
        Route::get('/{id}', [ProductController::class, "productById"]);
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/all', [CategoryController::class, "categoriesByPage"]);
        Route::get('/search/{term}', [CategoryController::class, "searchByName"]);
        Route::get('/{id}/products', [CategoryController::class, "categoryProductsByPage"]);
        Route::get('/{id}', [CategoryController::class, "categoryById"]);
    });

    Route::group(['prefix' => 'orders'], function () {
        Route::get('/all', [OrderController::class, "getAll"]);
        Route::get('/{id}/products', [OrderController::class, "orderProductsByPage"]);
        Route::get('/{id}', [OrderController::class, "orderById"]);
    });
    // Route::get('/test',[test::class,'getAll']);
});