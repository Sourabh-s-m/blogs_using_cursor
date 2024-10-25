<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\CategoryController;
use App\Http\Middleware\UserMiddleware;
use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
});
// Route::middleware(UserMiddleware::class)->group(function () {
//     Route::get('blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');
//     Route::get('blogs/{blog}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
//     Route::put('blogs/{blog}', [BlogController::class, 'update'])->name('blogs.update');
//     Route::delete('blogs/{blog}', [BlogController::class, 'destroy'])->name('blogs.destroy');
// });

// Blog routes with auth middleware
Route::middleware(['auth'])->group(function () {
    Route::resource('blogs', BlogController::class);
});

Route::get('/blog/{blog}', [FrontendController::class, 'show'])->name('blog.show');

// Add this route for category blogs
Route::get('/category/{category}', [FrontendController::class, 'categoryBlogs'])->name('category.blogs');
