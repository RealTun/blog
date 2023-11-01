<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\WebController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('admin')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('admin.auth.login');

    Route::post('login', [AuthController::class, 'checkLogin'])->name('admin.auth.check-login');
});

Route::prefix('admin')->middleware('admin.login')->group(function () {

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.auth.logout');

    Route::get('profile', [AuthController::class, 'profile'])->name('admin.profile.index');

    Route::put('profile', [AuthController::class, 'updateProfile'])->name('admin.profile.update');

    Route::get('dashboard', [HomeController::class, 'index'])->name('admin.home.index');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');

        Route::get('create', [CategoryController::class, 'create'])->name('admin.categories.create');

        Route::post('store', [CategoryController::class, 'store'])->name('admin.categories.store');

        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('admin.categories.edit');

        Route::put('update/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

        Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('admin.categories.delete');
    });

    Route::prefix('posts')->group(function () {
        Route::get('/', [PostController::class, 'index'])->name('admin.posts.index');

        Route::get('create', [PostController::class, 'create'])->name('admin.posts.create');

        Route::post('store', [PostController::class, 'store'])->name('admin.posts.store');

        Route::get('edit/{id}', [PostController::class, 'edit'])->name('admin.posts.edit');

        Route::put('update/{id}', [PostController::class, 'update'])->name('admin.posts.update');

        Route::get('delete/{id}', [PostController::class, 'delete'])->name('admin.posts.delete');
    });

    Route::prefix('contacts')->group(function () {
        Route::get('/', [ContactController::class, 'index'])->name('admin.contacts.index');

        Route::get('create', [ContactController::class, 'create'])->name('admin.contacts.create');

        Route::post('store', [ContactController::class, 'store'])->name('admin.contacts.store');

        Route::get('edit/{id}', [ContactController::class, 'edit'])->name('admin.contacts.edit');

        Route::put('update/{id}', [ContactController::class, 'update'])->name('admin.contacts.update');

        Route::get('delete/{id}', [ContactController::class, 'delete'])->name('admin.contacts.delete');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');

        Route::get('create', [UserController::class, 'create'])->name('admin.users.create');

        Route::post('store', [UserController::class, 'store'])->name('admin.users.store');

        Route::get('edit/{id}', [UserController::class, 'edit'])->name('admin.users.edit');

        Route::put('update/{id}', [UserController::class, 'update'])->name('admin.users.update');

        Route::get('delete/{id}', [UserController::class, 'delete'])->name('admin.users.delete');
    });
});


Route::get('/', [WebController::class, 'index']);

Route::get('category', [WebController::class, 'category'])->name('web.category');

Route::get('category/{slug}', [WebController::class, 'categorySlug']);

Route::get('post/{slug}', [WebController::class, 'postSlug'])->name('web.post');

Route::get('contact', [WebController::class, 'contact']);

Route::post('contact', [WebController::class, 'sendContact']);
