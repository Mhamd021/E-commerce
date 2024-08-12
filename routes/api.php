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


//auth
Route::post('login', 'App\Http\Controllers\Auth\api\AuthController@login');
Route::post('register', 'App\Http\Controllers\Auth\api\AuthController@register');
//products
Route::get('products', 'App\Http\Controllers\ProductController@apiIndex');
Route::get('categories', 'App\Http\Controllers\ProductController@Category');
Route::get('Allcategories', 'App\Http\Controllers\ProductController@AllCategory');

//shops
Route::get('shops', 'App\Http\Controllers\ShopsController@apishops');


Route::get('CategoryProducts/{id}', 'App\Http\Controllers\ProductController@CategoryProducts');
Route::get('ShopProducts/{id}', 'App\Http\Controllers\ProductController@ShopProducts');

//
Route::post("/sockets/connect", [App\Http\Controllers\SocketController::class, "connect"]);


Route::group(['middleware' => ['auth']], function() {
    Route::get('user', 'App\Http\Controllers\UserController@info');
    Route::get('orders', 'App\Http\Controllers\OrderController@apiOrders');
Route::get('activrorders', 'App\Http\Controllers\OrderController@ActiveOrders');

});
