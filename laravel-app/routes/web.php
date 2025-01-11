<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;





Route::get('/', [PostController::class, 'index'])->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/posts', [PostController::class, 'store'])->name('post.store');

    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');

    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {

    // 1) Show the current (logged-in) user’s profile
    Route::get('/profile', [ProfileController::class, 'showOwn'])
         ->name('profile.showOwn');

     // 3) Edit and Update the logged-in user’s profile
     Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
     Route::patch('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    // 2) Show *any* user's profile by ID (or username if you like)
    Route::get('/profile/{user}', [ProfileController::class, 'show'])
         ->name('profile.show');

   
});





require __DIR__.'/auth.php';