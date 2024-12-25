<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

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
Route::get('/products', [ProductController::class,'getProductsForView'])->name('products.index');
Route::get('/categories', [CategoryController::class, 'getCategoriesForView'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
Route::get('product/edit/{id}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('product/update/{id}', [ProductController::class, 'update'])->name('products.update');


