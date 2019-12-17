<?php

use Illuminate\Http\Request;

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
#category
Route::Post('/get-category-list', 'API\CategoryController@getCategoryList');
Route::Post('/category-wise-product', 'API\CategoryController@getCategoryWiseProduct');

#banner
Route::Post('/get-banners', 'API\BannerController@getbanners');

#product
Route::Post('/get-offer-products', 'API\ProductController@getOfferProducts');
Route::Post('/get-all-products', 'API\ProductController@getAllProducts');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

