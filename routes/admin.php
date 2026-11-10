<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
| Include this file from routes/web.php, e.g.:
|   require __DIR__.'/admin.php';
|
| These routes render the Blade views directly (no controllers yet) so the
| whole UI works with php artisan serve out of the box. Replace the closures
| with real controller methods once you wire up models/migrations.
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Route::get('login', fn() => view('auth.login'))->name('login');

    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('reports/sales', fn() => view('admin.reports.sales'))->name('reports.sales');

    // Products
    Route::post('/products/import', [ProductController::class, 'import'])->name('products.import');
    Route::get('/products/export', [ProductController::class, 'export'])->name('products.export');
    Route::resource('products', ProductController::class);

    // Categories
    Route::post('/categories/import', [CategoryController::class, 'import'])->name('categories.import');
    Route::get('/categories/export', [CategoryController::class, 'export'])->name('categories.export');
    Route::resource('categories', CategoryController::class);

    // Orders
    Route::get('orders', [OrderController::class, 'adminIndex'])->name('orders.index');
    Route::get('orders/{order}', [OrderController::class, 'adminShow'])->name('orders.show');

    // Customers
    Route::get('customers', [UserController::class, 'customers'])->name('customers.index');
    Route::get('customers/{user}', [UserController::class, 'showCustomer'])->name('customers.show');

    // Coupons
    Route::get('coupons', fn() => view('admin.coupons.index'))->name('coupons.index');
    Route::get('coupons/create', fn() => view('admin.coupons.create'))->name('coupons.create');
    Route::post('coupons', fn() => back())->name('coupons.store');
    Route::get('coupons/{id}/edit', fn($id) => view('admin.coupons.edit'))->name('coupons.edit');
    Route::put('coupons/{id}', fn($id) => back())->name('coupons.update');
    Route::delete('coupons/{id}', fn($id) => back())->name('coupons.destroy');

    // Reviews
    Route::get('reviews', fn() => view('admin.reviews.index'))->name('reviews.index');

    // Blog
    Route::get('blog', fn() => view('admin.blog.index'))->name('blog.index');
    Route::get('blog/categories', fn() => view('admin.blog.categories'))->name('blog.categories');
    Route::get('blog/create', fn() => view('admin.blog.create'))->name('blog.create');
    Route::post('blog', fn() => back())->name('blog.store');
    Route::get('blog/{id}/edit', fn($id) => view('admin.blog.edit'))->name('blog.edit');
    Route::put('blog/{id}', fn($id) => back())->name('blog.update');
    Route::delete('blog/{id}', fn($id) => back())->name('blog.destroy');

    // Banners
    Route::get('banners', fn() => view('admin.banners.index'))->name('banners.index');
    Route::get('banners/create', fn() => view('admin.banners.create'))->name('banners.create');
    Route::post('banners', fn() => back())->name('banners.store');
    Route::get('banners/{id}/edit', fn($id) => view('admin.banners.edit'))->name('banners.edit');
    Route::put('banners/{id}', fn($id) => back())->name('banners.update');
    Route::delete('banners/{id}', fn($id) => back())->name('banners.destroy');

    // Users
    Route::resource('users', UserController::class);

    // Roles
    Route::get('roles', fn() => view('admin.roles.index'))->name('roles.index');

    // Settings
    Route::get('settings', fn() => view('admin.settings.index'))->name('settings.index');
});
