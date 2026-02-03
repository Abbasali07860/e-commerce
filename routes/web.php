<?php

use App\Http\Controllers\ContactFormController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserSubscribeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
})->name('home');

Route::get('/home', function () {
    return view('auth.login');
})->name('login');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/services', function () {
    return view('services');
})->name('services');

Route::get('/blog', function () {
    return view('blog');
})->name('blog');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('checkout');
})->name('checkout');

Auth::routes();

Route::post('/subscribe', [UserSubscribeController::class, 'subscribe'])->name('subscribe');
Route::post('/contact', [ContactFormController::class, 'store'])->name('store');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/load-more-products', [HomeController::class, 'loadMore'])->name('load.more');

Route::get('/cart', [CartController::class, 'showCart'])->name('cart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::get('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update-qty', [CartController::class, 'updateQty'])->name('cart.update-qty');
Route::post('/cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::post('/cart/remove-coupon', [CartController::class, 'removeCoupon'])->name('cart.remove-coupon');


Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::get('/shop', [ProductController::class, 'index'])->name('shop');
Route::get('/shop/load-more', [ProductController::class, 'loadMore'])->name('load.more');
Route::get('/products/search', [ProductController::class, 'searchProducts'])->name('products.search');


