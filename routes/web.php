<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "MY BLOG IS LIVE";
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
use App\Http\Controllers\BlogController;

Route::get('/blogs/filter', [BlogController::class, 'filter'])
    ->name('blogs.filter');

Route::get('/blogs/search', [BlogController::class, 'search'])
    ->name('blogs.search');

Route::middleware('auth')->group(function () {

    Route::resource('blogs', BlogController::class);

});
