<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{Admin\DashboardController, CategoryController, PostController};
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/user', [DashboardController::class, 'user'])->name('admin.user');
    Route::get('/user//edit/{id}', [DashboardController::class, 'edit'])->name('admin.user.edit');
    Route::get('/user/update/{id}', [DashboardController::class, 'update'])->name('admin.user.update');
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::resource('/category', CategoryController::class);
    Route::resource('/post', PostController::class);
});
