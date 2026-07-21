<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Composer\DashboardController as ComposerDashboardController;

Route::get('/', [HomeController::class,'index'])->name('home');

Route::get('/post/{post:slug}', [HomeController::class,'show'])
    ->name('post.show');

Route::get('/category/{category:slug}', [HomeController::class,'category'])
    ->name('category.show');
// Default dashboard (we'll improve this in the next step)
Route::get('/dashboard', function () {

    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if (auth()->user()->hasRole('composer')) {
        return redirect()->route('composer.dashboard');
    }

    return redirect()->route('home');

})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('categories', CategoryController::class);

        Route::get('/users', [UserController::class, 'index'])
            ->name('users.index');

        Route::put('/users/{user}', [UserController::class, 'update'])
            ->name('users.update');

        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy');

        Route::resource('posts', AdminPostController::class)
            ->except(['show']);

        Route::put(
                'posts/{post}/approve',
                [AdminPostController::class,'approve']
            )->name('posts.approve');

            Route::put(
                'posts/{post}/reject',
                [AdminPostController::class,'reject']
            )->name('posts.reject');    
            });

// Composer Routes
Route::middleware(['auth', 'role:composer'])
    ->prefix('composer')
    ->name('composer.')
    ->group(function () {

        Route::get('/dashboard', [ComposerDashboardController::class, 'index'])
            ->name('dashboard');

       Route::resource('posts', PostController::class);

        Route::put(
            'posts/{post}/submit',
            [PostController::class, 'submit']
        )->name('posts.submit');
    });

// Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::post('/post/{post}/comment', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::post('/post/{post}/like', [LikeController::class, 'toggle'])
        ->name('likes.toggle');

});
require __DIR__.'/auth.php';