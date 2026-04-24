<?php

// All the routes for the blog. Each route maps a URL to a controller method.
// The middleware(AdminAuth::class) calls on admin routes run my AdminAuth
// middleware first -- if you're not logged in it redirects to /admin/login.

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingsController;

// Public routes -- no login required

Route::get('/', [HomeController::class, 'index']);

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{slug}', [PostController::class, 'show']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);
Route::post('/contact', [ContactController::class, 'send']);

// Admin login/logout -- these have to be outside the middleware group
// otherwise you'd get stuck in a redirect loop trying to reach the login page
Route::get('/admin/login', [AdminController::class, 'login']);
Route::post('/admin/login', [AdminController::class, 'loginPost']);
Route::post('/admin/logout', [AdminController::class, 'logout']);

// Protected admin routes -- middleware checks for admin_authed in the session
Route::get('/admin', [AdminController::class, 'index'])->middleware(AdminAuth::class);
Route::post('/admin/upload', [AdminController::class, 'upload'])->middleware(AdminAuth::class);

Route::get('/admin/messages', [AdminController::class, 'messages'])->middleware(AdminAuth::class);

Route::get('/admin/settings', [SettingsController::class, 'index'])->middleware(AdminAuth::class);
Route::post('/admin/settings', [SettingsController::class, 'save'])->middleware(AdminAuth::class);

// Post editing -- {slug} gets passed into the controller method automatically
Route::get('/admin/posts/{slug}/edit', [AdminController::class, 'edit'])->middleware(AdminAuth::class);
Route::post('/admin/posts/{slug}/edit', [AdminController::class, 'update'])->middleware(AdminAuth::class);

Route::post('/admin/images/upload', [AdminController::class, 'uploadImage'])->middleware(AdminAuth::class);
