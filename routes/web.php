<?php

use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    abort(404);
});

Route::resource('posts', PostController::class);

Route::view('profile', 'profile.edit')->name('profile.edit');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
    Route::post('/bookmarks/{post}/toggle', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
});

// home page link
// http://localhost/Blog/public/posts
