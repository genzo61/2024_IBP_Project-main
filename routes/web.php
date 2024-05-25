<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [AppController::class,'index'])->Name('app.index');
Route::get('/shop', [ShopController::class,'index'])->name('shop.index');
Route::get('/product/{slug}', [ShopController::class,'productDetails'])->name('shop.product.details');
Route::get('/cart', [CartController::class,'index'])->name('cart.index');
Route::post('/cart/store', [CartController::class,'AddToCart'])->name('cart.store');
Route::put('cart/update', [CartController::class,'updateProduct'])->name('cart.update');
Route::delete('cart/remove', [CartController::class,'removeItem'])->name('cart.remove');
Route::delete('cart/clear', [CartController::class,'clearCart'])->name('cart.clear');
Route::post('/wishlist/add',[WishlistController::class,'addtoproducttowishlist'])->name('wishlist.store');
Route::get('/cart-wishlist-count', [ShopController::class,'getcartandwishlistcount'])->name('shop.cart.wishlist.count');
Route::get('/wishlist', [WishlistController::class,'getwishlistedproduct'])->name('wishlist.list');
Route::delete('/wishlist/remove',[WishlistController::class,'removeproductfromwishlist'])->name('wishlist.remove');
Route::delete('/wishlist/clear',[WishlistController::class,'clearwishlist'])->name('wishlist.clear');
Route::post('/wishlist/move-to-cart',[WishlistController::class,'movetocart'])->name('wishlist.move.to.cart');
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/my-account',[UserController::class,'index'])->name('user.index');
});
Route::middleware('auth','auth.admin')->group(function () {
    Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
});
