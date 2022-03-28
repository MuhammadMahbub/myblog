<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{HomeController, CommentController, FrontendController, Admin\DashboardController, CategoryController, PostController, SettingController};
use Illuminate\Support\Facades\Auth;


Route::get('/', [FrontendController::class, 'index']);
Route::get('/tutorial/{category_name}', [FrontendController::class, 'viewcategory'])->name('viewcategory');
Route::get('/tutorial/post/{cat_name}/{post_name}', [FrontendController::class, 'viewpost'])->name('viewpost');

// Comment part
Route::post('post/comment', [CommentController::class, 'postcomment'])->name('postcomment');
Route::post('delete_comment', [CommentController::class, 'destroy']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/user', [DashboardController::class, 'user'])->name('admin.user');
    Route::get('/user//edit/{id}', [DashboardController::class, 'edit'])->name('admin.user.edit');
    Route::get('/user/update/{id}', [DashboardController::class, 'update'])->name('admin.user.update');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/category', CategoryController::class);
    Route::post('categorydelete', [CategoryController::class, 'categorydelete'])->name('categorydelete');
    Route::resource('/post', PostController::class);
    Route::get('/setting', [SettingController::class, 'index'])->name('admin.setting');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');
});
