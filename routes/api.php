<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//註冊 categories API 的路由
//可搭配 php artisan make:controller Api/CategoryController --resource --api 來生成檔案
Route::apiResource('categories','App\Http\Controllers\Api\CategoryController');
Route::get('categories/products/{id}','App\Http\Controllers\Api\CategoryController@categoryProducts');


//註冊 products API 的路由
Route::post('products/updateCategory','App\Http\Controllers\Api\ProductController@updateCategory');
//可搭配 php artisan make:controller Api/ProductController --resource --api 來生成檔案
Route::apiResource('products','App\Http\Controllers\Api\ProductController');


//註冊 orders API 的路由
//可搭配 php artisan make:controller Api/OrderController --resource --api 來生成檔案
Route::apiResource('orders','App\Http\Controllers\Api\OrderController');
