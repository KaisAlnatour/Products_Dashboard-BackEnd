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

Route::post('register', 'API\UserController@register');
Route::post('login', 'API\UserController@login');
Route::post('addProduct', 'API\ProductController@addProduct');
Route::post('editProduct/{id}', 'API\ProductController@editProduct');
Route::delete('deleteProduct/{id}', 'API\ProductController@deleteProduct');
Route::get('getAll', 'API\ProductController@getAllProduct');
Route::get('getById/{id}', 'API\ProductController@getProductById');
Route::get('getByName/{name}', 'API\ProductController@getProductByName');
