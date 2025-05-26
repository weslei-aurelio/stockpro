<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return redirect('/login');
});

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    });

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController:: class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController:: class, 'update'])->name('users.update');

});

