<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;


// / redirects to /posts
Route::get('/', fn() => redirect('/posts'));

// /posts → list all posts
Route::get('/posts', [PostController::class, 'index']);

// /posts/hello-world → single post
Route::get('/posts/{slug}', [PostController::class, 'show']);

// /admin + admin post
Route::get('/admin', [AdminController::class, 'index'])->middleware(AdminAuth::class);
Route::post('/admin/upload', [AdminController::class, 'upload'])->middleware(AdminAuth::class);

// /admin/login + login post
Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'loginPost']);
