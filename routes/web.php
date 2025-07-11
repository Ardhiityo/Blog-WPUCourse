<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::resource('posts', PostController::class)->except('show');

Route::get('posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('dashboard', DashboardController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
