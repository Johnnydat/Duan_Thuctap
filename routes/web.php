<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminMiddleware;

// đăng ký , đăng nhập
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('register', [AuthController::class, 'register'])->name('register');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('client.home');
})->name('test');

// router cho admin
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::prefix('/categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        Route::get('/trash', [CategoryController::class, 'trashed'])->name('trash');
        Route::post('/{id}/restore', [CategoryController::class, 'restore'])->name('restore');
        Route::delete('/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('force-delete');
    });

    //Post
    Route::prefix('post')->name('post.')->group(function () {
        Route::get('/',                     [PostController::class, 'index'])->name('index');
        Route::get('/create',               [PostController::class, 'create'])->name('create');
        Route::get('/{id}/show',               [PostController::class, 'show'])->name('show');
        Route::post('/store',               [PostController::class, 'store'])->name('store');
        Route::get('/{id}/edit',            [PostController::class, 'edit'])->name('edit');
        Route::put('/{id}/update',          [PostController::class, 'update'])->name('update');
        Route::delete('/{id}/destroy',      [PostController::class, 'destroy'])->name('destroy');
        Route::get('/trash',                [PostController::class, 'trash'])->name('trash');
        Route::patch('/{id}/restore',       [PostController::class, 'restore'])->name('restore');
        Route::delete('/{id}/forceDelete',  [PostController::class, 'forceDelete'])->name('forceDelete');
    });
});
