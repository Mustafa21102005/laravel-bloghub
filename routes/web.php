<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::resource('posts', PostController::class);

Route::fallback(function () {
    abort(404);
});

//  this is the home page
// http://localhost/Blog/public/posts