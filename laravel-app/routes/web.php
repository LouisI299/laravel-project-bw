<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\FriendRequestController;
use App\Http\Controllers\ProposedFaqController;





Route::get('/', [PostController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::post('/friend-request/send/{receiverId}', [FriendRequestController::class, 'send'])->name('friend-request.send');
    Route::post('/friend-request/accept/{requestId}', [FriendRequestController::class, 'accept'])->name('friend-request.accept');
    Route::post('/friend-request/decline/{requestId}', [FriendRequestController::class, 'decline'])->name('friend-request.decline');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');

    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('/post/{post}', [PostController::class, 'update'])->name('post.update');

    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');
});

Route::get('/users/search', [ProfileController::class, 'search'])->name('users.search');



Route::middleware(['auth'])->group(function () {
    Route::post('/friends/{friendId}/add', [FriendController::class, 'add'])->name('friends.add');
    Route::post('/friends/{friendId}/remove', [FriendController::class, 'remove'])->name('friends.remove');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [PostController::class, 'friendsPosts'])->name('dashboard');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
});

Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');

Route::middleware(['auth'])->group(function () {
    // User route to propose a question
    Route::get('/faq/propose', [ProposedFaqController::class, 'create'])->name('faq.propose');
    Route::post('/faq/propose', [ProposedFaqController::class, 'store'])->name('proposed-faq.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes to manage proposed FAQs
    Route::get('/admin/proposed-faqs', [ProposedFaqController::class, 'index'])->name('admin.proposed-faqs.index');
    Route::post('/admin/proposed-faqs/{id}/approve', [ProposedFaqController::class, 'approve'])->name('admin.proposed-faqs.approve');
    Route::post('/admin/proposed-faqs/{id}/reject', [ProposedFaqController::class, 'reject'])->name('admin.proposed-faqs.reject');
});

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/messages', [ContactController::class, 'showMessages'])->name('admin.contact.index');
});


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