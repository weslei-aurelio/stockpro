<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\UserController;
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
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}/inactivate',   [UserController::class, 'inactivate'])->name('users.inactivate');
    Route::post('/users/{user}/activate',       [UserController::class, 'activate'])->name('users.activate');

    Route::get('/brands/create',    [BrandController::class, 'create'])->name('brands.create');
    Route::post('/brands/create',   [BrandController::class, 'store'])->name('brands.store');
    Route::get('/brands',           [BrandController::class, 'index'])->name('brands.index');
    
});

