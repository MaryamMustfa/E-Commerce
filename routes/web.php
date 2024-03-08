<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderListController;
use App\Http\Controllers\CartController;






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
 // for registration and login

Route::get('/', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login-form', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/logout', 'AuthController@logout')->name('logout');




//admin routes
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'showDashboard'])->name('admin.dashboard');
    Route::get('/admin/all-shops', [AdminController::class, 'showAllShops'])->name('admin.allShops');
    Route::get('/admin/all-products', [AdminController::class, 'showAllProducts'])->name('admin.allProducts');
    Route::get('/admin/shop-products/{shopId}', [AdminController::class, 'showShopProducts'])->name('admin.shopProducts');


    Route::get('/admin/get-shops', [AdminController::class, 'getShops'])->name('admin.getShops');

    // Route for DataTables to get all products
    Route::get('/admin/get-products', [AdminController::class, 'getProducts'])->name('admin.getProducts');
    Route::get('/admin/get-shop-products/{shopId}', [AdminController::class, 'getShopProducts'])->name('admin.getShopProducts');




    //create shop
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');

    // active or deactive shop 

    Route::get('/admin/shop/activate/{shopId}', [AdminController::class, 'activateShop'])->name('admin.activateShop');
    Route::get('/admin/shop/deactivate/{shopId}', [AdminController::class, 'deactivateShop'])->name('admin.deactivateShop');


    // handle products 
    Route::resource('products', ProductController::class);

    // routes for user


Route::get('/ecom', [PageController::class, 'home'])->name('home');
Route::get('/seemore', [PageController::class, 'seeMore'])->name('seemore');
Route::get('/product/{id}', [PageController::class, 'productDetail'])->name('product.detail');
Route::get('/shopcarousel', [PageController::class, 'shopCarousel'])->name('shopcarousel');
Route::get('/shopdetail/{shop}', [PageController::class, 'shopDetail'])->name('shopdetail');
Route::get('/invoice/{id}', [CheckoutController::class, 'invoice'])->name('invoice');
Route::post('/checkout/{productId}', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/orders', [OrderListController::class, 'index'])->name('orders.index');
Route::get('/orders/{orderId}', [OrderListController::class,'show'])->name('orders.show');

//Shop order 

Route::get('/shop/orders', [ShopController::class, 'shoporder'])->name('shop.orders');

// Admin Order 

Route::get('/admin/orders', [AdminController::class, 'order'])->name('admin.orders');



// add to cart button
Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/product/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/product/remove-from-cart/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');

// for checkout all produts of cart
Route::post('/checkout-all',  [CartController::class,'checkoutAll'])->name('checkout-all');

});




