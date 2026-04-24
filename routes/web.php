<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// / redirects to /posts
Route::get('/', fn() => redirect('/posts'));

// /posts → list all posts
Route::get('/posts', [PostController::class, 'index']);

// /posts/hello-world → single post
Route::get('/posts/{slug}', [PostController::class, 'show']);
