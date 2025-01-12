<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController;





Route::get('/', [PostController::class, 'index'])->name('home');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users');
    Route::post('/admin/users/{user}/promote', [AdminController::class, 'promote'])->name('admin.promote');
    Route::post('/admin/users/{user}/demote', [AdminController::class, 'demote'])->name('admin.demote');
    Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/admin/faq', FaqController::class)->except(['index', 'show']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');

    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');

    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
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