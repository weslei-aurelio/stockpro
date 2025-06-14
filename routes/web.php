<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PdvController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;



use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect('/login');
});

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users/create',[UserController::class, 'store'])->name('users.store');
    Route::get('/users',        [UserController::class, 'index'])->name('users.index');
    Route::put('/users/{user}/edit', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}/inactivate', [UserController::class, 'inactivate'])->name('users.inactivate');
    Route::post('/users/{user}/activate',     [UserController::class, 'activate'])->name('users.activate');

    Route::get('/brands/create',  [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/create', [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands',         [BrandController::class, 'index'])->name('brands.index');

    Route::get('categories',         [CategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create',  [CategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/create', [CategoryController::class, 'store'])->name('categories.store');

    Route::get('/products',         [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create',  [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/create', [ProductController::class, 'store'])->name('products.store');
    Route::get('/search-products',  [ProductController::class, 'search']);
    
    Route::get('/pdv',                   [PdvController::class, 'index'])->name('pdv.index');
    Route::post('/sales',                [PdvController::class, 'storeSale'])->name('pdv.storeSale');
    
    Route::get('/movement-report',       [SaleController::class, 'movementReport'])->name('movementReport.index');
    Route::get('/best-selling-products', [SaleController::class, 'bestSellingProducts'])->name('bestSellingProducts.index');

    Route::get('/suppliers',          [SupplierController::class, 'index'])->name('suppliers.index');
    Route::get('/suppliers/create',   [SupplierController::class, 'crate'])->name('suppliers.create');
    Route::post('/suppliers/create',  [SupplierController::class, 'store'])->name('suppliers.store');
});
