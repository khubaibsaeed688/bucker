<?php

use App\Http\Controllers\frontend\AccountController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\frontend\CheckoutController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\frontend\SafepayWebhookController;
use App\Http\Controllers\Frontend\ShopController;
use App\Http\Controllers\frontend\WishlistController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Storefront routes (static template pages)
|--------------------------------------------------------------------------
| Load from routes/web.php with:  require __DIR__.'/frontend.php';
| (and remove the default "/" welcome route there).
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('home-two', [HomeController::class, 'homeTwo'])->name('home.two');

// Static pages
Route::view('about', 'frontend.pages.about')->name('about');
Route::view('contact', 'frontend.pages.contact')->name('contact');
Route::view('faq', 'frontend.pages.faq')->name('faq');
Route::view('404', 'frontend.pages.not-found')->name('not-found');

// Shop
Route::get('shop/fullwidth', [ShopController::class, 'fullwidth'])->name('shop.fullwidth');
Route::get('shop/left-sidebar', [ShopController::class, 'leftSidebar'])->name('shop.left-sidebar');
Route::get('shop/right-sidebar', [ShopController::class, 'rightSidebar'])->name('shop.right-sidebar');
Route::get('shop/list-fullwidth', [ShopController::class, 'listfullwidth'])->name('shop.list-fullwidth');
Route::get('shop/list-left-sidebar', [ShopController::class, 'listleftSidebar'])->name('shop.list-left-sidebar');
Route::get('shop/list-right-sidebar', [ShopController::class, 'listrightSidebar'])->name('shop.list-right-sidebar');
Route::redirect('shop', '/shop/left-sidebar');

// Products
// Route::view('product/single', 'frontend.product.single')->name('product.single');
Route::get('/product/single/{slug}', [ProductController::class, 'show'])
    ->name('product.single');
Route::view('product/affiliate', 'frontend.product.affiliate')->name('product.affiliate');
Route::view('product/group', 'frontend.product.group')->name('product.group');
Route::view('product/sale', 'frontend.product.sale')->name('product.sale');
Route::view('product/sticky', 'frontend.product.sticky')->name('product.sticky');
Route::view('product/variable', 'frontend.product.variable')->name('product.variable');

// Blog archives
Route::view('blog/fullwidth', 'frontend.blog.fullwidth')->name('blog.fullwidth');
Route::view('blog/left-sidebar', 'frontend.blog.left-sidebar')->name('blog.left-sidebar');
Route::view('blog/right-sidebar', 'frontend.blog.right-sidebar')->name('blog.right-sidebar');
Route::view('blog/list-fullwidth', 'frontend.blog.list-fullwidth')->name('blog.list-fullwidth');
Route::view('blog/list-left-sidebar', 'frontend.blog.list-left-sidebar')->name('blog.list-left-sidebar');
Route::view('blog/list-right-sidebar', 'frontend.blog.list-right-sidebar')->name('blog.list-right-sidebar');
Route::redirect('blog', '/blog/left-sidebar');

// Blog posts
Route::view('blog/detail/fullwidth', 'frontend.blog.detail.fullwidth')->name('blog.detail.fullwidth');
Route::view('blog/detail/left-sidebar', 'frontend.blog.detail.left-sidebar')->name('blog.detail.left-sidebar');
Route::view('blog/detail/right-sidebar', 'frontend.blog.detail.right-sidebar')->name('blog.detail.right-sidebar');

// Cart, checkout, wishlist, compare
Route::middleware(['auth', 'customer'])->group(function () {

    Route::get('/cart', [CartController::class, 'index'])
        ->name('cart');

    Route::post('/cart/{product}', [CartController::class, 'store'])
        ->name('cart.store');

    Route::patch('/cart/{id}', [CartController::class, 'update'])
        ->name('cart.update');

    Route::delete('/cart/{id}', [CartController::class, 'destroy'])
        ->name('cart.destroy');

    Route::get('/wishlist', [WishlistController::class, 'index'])
        ->name('wishlist');

    Route::post('/wishlist/{product}', [WishlistController::class, 'store'])
        ->name('wishlist.store');

    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])
        ->name('wishlist.destroy');

    Route::get('/checkout', [CheckoutController::class, 'index'])
        ->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'store'])
        ->name('checkout.store');

    // Customer account
    Route::get('account', [AccountController::class, 'index'])
        ->name('account.dashboard');

    Route::get('/account/orders/{id}', [AccountController::class, 'showOrder'])
        ->name('account.orders.show');

    Route::put('/my-account/details', [UserController::class, 'updateAccountDetails'])
        ->name('account.details.update');

    Route::get('/payment/safepay/success/{order}', [CheckoutController::class, 'safepaySuccess'])
        ->name('payment.safepay.success');

    Route::get('/payment/safepay/cancel/{order}', [CheckoutController::class, 'safepayCancel'])
        ->name('payment.safepay.cancel');

    Route::post('/webhooks/safepay', [SafepayWebhookController::class, 'handle'])
        ->name('webhooks.safepay');

    Route::post('/webhooks/safepay', [CheckoutController::class, 'safepayWebhook'])
        ->name('webhooks.safepay');
});
Route::view('compare', 'frontend.cart.compare')->name('compare');

// Customer account
Route::view('account/login-register', 'frontend.account.login-register')->name('account.login-register');
