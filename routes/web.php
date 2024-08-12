<?php

use Illuminate\Support\Facades\Route;
use App\Events\RealTimeMessage;
 use BeyondCode\LaravelWebSockets\Apps\AppProvider;
 use BeyondCode\LaravelWebSockets\Dashboard\DashboardLogger;
 use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


//Routes for auth
Auth::routes();
Route::get('/showuser', [App\Http\Controllers\HomeController::class, 'showusers'])->name('showusers');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//cart
Route::group(['middleware' => ['auth']], function() {
    Route::get('/addToCart/{product}', [App\Http\Controllers\ProductController::class, 'addToCart'])->name('cart.add');
Route::get('/minus', [App\Http\Controllers\ProductController::class, 'minus'])->name('cart.minus');
Route::get('/shopping-cart', [App\Http\Controllers\ProductController::class, 'showCart'])->name('cart.show');
Route::get('/checkout', [App\Http\Controllers\ProductController::class, 'checkout'])->name('cart.checkout');
Route::delete('/products/{product}',[App\Http\Controllers\ProductController::class, 'removefromcart'])->name('cart.remove');
});
Route::get('/product_list', [App\Http\Controllers\ProductController::class, 'product_list'])->name('product_list');
Route::post('/searchproducts', [App\Http\Controllers\ProductController::class, 'searchproducts'])->name('searchproducts');


//Routes for User Roles and Permissions
Route::group(['middleware' => ['role:super_admin']], function() {
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::resource('roles','App\Http\Controllers\RoleController');
    Route::get('/Super_Admin/home',[App\Http\Controllers\ProductController::class, 'SuperAdmin'])->name('admin.home');
    Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get('/allshops', [App\Http\Controllers\ShopsController::class, 'allShops'])->name('allshops');
    Route::get('/categories', [App\Http\Controllers\CategoryController::class, 'index'])->name('categories');
    Route::get('/category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category/update/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('category.update');


});
Route::get('/category/all', [App\Http\Controllers\CategoryController::class, 'allCategory'])->name('category.all');
Route::get('/category/show/{id}', [App\Http\Controllers\CategoryController::class, 'show'])->name('category.show');
Route::group(['middleware' => ['auth']], function() {

    Route::resource('messages', App\Http\Controllers\MessageController::class);
    Route::get('/profile/{id}', [App\Http\Controllers\UserController::class, 'showProfile'])->name('profile');
    Route::put('/UpdateProfile/{id}', [App\Http\Controllers\UserController::class, 'UpdateProfile'])->name('UpdateProfile');
    Route::get('/Delete/{id}', [App\Http\Controllers\UserController::class, 'DeleteImage'])->name('Delete.Profile.Image');
    Route::post('/rating/add', [App\Http\Controllers\ProductRatingController::class, 'addRating'])->name('rating.add');
});
    //Route for Products

    Route::get('/product/show/{id}', [App\Http\Controllers\ProductController::class, 'show'])->name('product.show');

    Route::group(['middleware' => ['role:shop_owner']], function() {

        Route::post('/product/store', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
        Route::get('/product/create/{id}', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
        Route::get('/product/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('product.edit');
        Route::put('/product/update/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
        Route::get('/product/destroy/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');
        });

    //Routes for shops



    Route::get('/shops', [App\Http\Controllers\ShopsController::class, 'index'])->name('shops');
    Route::get('/shop/show/{id}', [App\Http\Controllers\ShopsController::class, 'show'])->name('shop.show');
    Route::group(['middleware' => ['role:shop_owner']], function() {
    Route::get('/shop/create', [App\Http\Controllers\ShopsController::class, 'create'])->name('shop.create');
    Route::post('/shop/store', [App\Http\Controllers\ShopsController::class, 'store'])->name('shop.store');
    Route::get('/shop/edit/{id}', [App\Http\Controllers\ShopsController::class, 'edit'])->name('shop.edit');
    Route::put('/shop/update/{id}', [App\Http\Controllers\ShopsController::class, 'update'])->name('shop.update');
    Route::get('/shop/destroy/{id}', [App\Http\Controllers\ShopsController::class, 'destroy'])->name('shop.destroy');
    Route::get('/ShopOwner',[App\Http\Controllers\ShopsController::class, 'ownerHome'])->name('shop.owner');
    });




    //delivery
    Route::get('/delivery/show/{id}', [App\Http\Controllers\DeliveryController::class, 'show'])->name('delivery.show');
    Route::group(['middleware' => ['role:delivery_serviceprovider']], function() {
    Route::get('/delivery/create', [App\Http\Controllers\DeliveryController::class, 'create'])->name('delivery.create');
    Route::post('/delivery/store', [App\Http\Controllers\DeliveryController::class, 'store'])->name('delivery.store');
    Route::get('/delivery/edit/{id}', [App\Http\Controllers\DeliveryController::class, 'edit'])->name('delivery.edit');
    Route::put('/delivery/update/{id}', [App\Http\Controllers\DeliveryController::class, 'update'])->name('delivery.update');
    Route::get('/delivery/destroy/{id}', [App\Http\Controllers\DeliveryController::class, 'destroy'])->name('delivery.destroy');
    Route::get('/DeliveryOwner',[App\Http\Controllers\DeliveryController::class, 'deliverHome'])->name('delivery.home');
    // Route::post('/delivery-shop/{id}', [App\Http\Controllers\DeliveryController::class, 'attach'])->name('delivery.shops');



    });

    //rating

    //orders

    Route::post('/order/store', [App\Http\Controllers\OrderController::class, 'store'])->name('order.store');
    Route::get('/order/show/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('order.show');
    Route::get('/order/shop/{id}', [App\Http\Controllers\OrderController::class, 'shop'])->name('order.shop');
    Route::get('/order/user', [App\Http\Controllers\OrderController::class, 'User'])->name('order.User');
    Route::put('/order/delivered/{id}', [App\Http\Controllers\OrderController::class, 'deliverd'])->name('order.deliverd');
    Route::get('/order/UserDelivered/{id}', [App\Http\Controllers\OrderController::class, 'UserDelivered'])->name('order.UserDelivered');

    Route::get('/order/IsDone/{id}', [App\Http\Controllers\OrderController::class, 'done'])->name('order.done');

    Route::match(['put','post'],'/product/IsReady/{id}', [App\Http\Controllers\OrderController::class, 'ready'])->name('product.ready');

    Route::get('/mark-as-read', [App\Http\Controllers\OrderController::class, 'markAsRead'])->name('mark-as-read');


    Route::get('/event',function()
    {
        event(new \App\Events\RealTimeMessage(1,2,"hello"));
        return null;
    });
    Route::get('/playground',function()
    {

        return null;
    });





