<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ThemeController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ThemeController::class, 'index'])->name('index');

Route::get('/post/create', [ThemeController::class, 'createPost'])->name('create.post');

Route::post('/post/store', [PostController::class, 'store'])->name('post.store');

Route::get('/post/{id}/delete', [PostController::class, 'destroy'])->name('posts.delete');

Route::get('/post/edit/{id}', [ThemeController::class, 'editPost'])->name('edit.post');

Route::post('/post/update/{id}', [PostController::class, 'update'])->name('post.update');

Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
