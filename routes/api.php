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
Route::Post('/get-category-list', 'API\MainApiController@getCategoryList');
Route::Post('/get-banners', 'API\MainApiController@getbanners');
Route::Post('/get-offer-products', 'API\MainApiController@getOfferProducts');
Route::Post('/get-all-products', 'API\MainApiController@getAllProducts');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

