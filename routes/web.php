<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Composer\DashboardController as ComposerDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Default dashboard (we'll improve this in the next step)
Route::get('/dashboard', function () {

    if (auth()->user()->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('composer.dashboard');

})->middleware(['auth', 'verified'])->name('dashboard');

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');

});

// Composer Routes
Route::middleware(['auth', 'role:composer'])->prefix('composer')->group(function () {

    Route::get('/dashboard', [ComposerDashboardController::class, 'index'])
        ->name('composer.dashboard');

});

// Profile
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

});

require __DIR__.'/auth.php';