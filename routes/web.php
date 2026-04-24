<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;

// / → home page
Route::get('/', [HomeController::class, 'index']);

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

// /admin/logout
Route::post('/admin/logout', [AdminController::class, 'logout']);

// /admin/messages
Route::get('/admin/messages', [AdminController::class, 'messages'])->middleware(AdminAuth::class);

// /Contact page
Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'send']);

// /About page
Route::get('about', [AboutController::class, 'index']);
