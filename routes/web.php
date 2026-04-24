<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


// / redirects to /posts
Route::get('/', fn() => redirect('/posts'));

// /posts → list all posts
Route::get('/posts', [PostController::class, 'index']);

// /posts/hello-world → single post
Route::get('/posts/{slug}', [PostController::class, 'show']);

// /admin + admin post
Route::get('/admin', [AdminController::class, 'index']);
Route::post('/admin/upload', [AdminController::class, 'upload']);
