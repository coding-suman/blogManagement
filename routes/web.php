<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [DashboardController::class, 'home'])->name('welcome');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login/authenticate', [AuthController::class, 'authenticate'])->name('user.authenticate');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister'])->name('user.register');

Route::middleware(['auth'])->group(function () {
    Route::get('/myblog', [DashboardController::class, 'index'])->name('myblogs');
    Route::resource('blog', BlogController::class);
    Route::get('blog/myblog/{id}', [BlogController::class, 'myBlog'])->name('blog.myblog');
});

// Route::middleware('guest')->group(function () {
// });

Route::get('blogs', [BlogController::class, 'index'])->name('blog.index');
Route::get('blogs/view/{id}', [BlogController::class, 'show'])->name('blog.show');

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});