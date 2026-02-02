<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('login', [LoginController::class, 'view'])->name('login');
Route::post('login-post', [LoginController::class, 'login'])->name('login-post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)->only(['store', 'destroy']);
    Route::resource('gallery', GalleryController::class);
    Route::resource('activity', ActivityController::class);
    Route::delete('activity-image/{image}', [ActivityController::class, 'destroyImage'])
        ->name('activity.image.destroy');
    Route::resource('product', ProductController::class);
    Route::delete('product-image/{image}', [ProductController::class, 'destroyImage'])
        ->name('product.image.destroy');
});