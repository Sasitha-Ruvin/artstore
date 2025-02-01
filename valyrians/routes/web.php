<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductViewController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\CartController;

Route::post('/featured-products', [FeaturedProductController::class, 'store'])->name('featured-products.store');
Route::get('/featured-products', [FeaturedProductController::class, 'index'])->name('featured-products.index');

// Admin Dashboard
Route::middleware('auth')->group(function(){
    Route::get('/admin/dashboard', [AdminController::class,'dashboard'])->name('admin.dashboard');
    Route::get('/categories', [CategoryController::class, 'getCategoriesForView'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::get('/featured-products/create', [FeaturedProductController::class, 'create'])->name('featured-products.create');
    Route::delete('/featured-products/{id}', [FeaturedProductController::class, 'destroy'])->name('featured-products.destroy');
    Route::get('/cart/view', [CartController::class, 'view'])->name('cart.view');
});

// Admin Login Route

Route::middleware('guest')->group(function(){
    Route::get('/admin/login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('/admin/login', [AdminLoginController::class,'store']);
});


// Admin Logout Route
Route::post('/admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');


Route::get('/', function () {
    return view('welcome');
});
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/api/categories', [CategoryController::class, 'index']);


Route::get('/products/create', [ProductViewController::class, 'create'])->name('products.create');
Route::get('/products', [ProductViewController::class,'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('product/update/{id}', [ProductController::class, 'update'])->name('products.update');

Route::get('/arts', [App\Http\Controllers\ProductPageController::class, 'index']);


