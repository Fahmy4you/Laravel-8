<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UmumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardPostController;

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [UmumController::class, 'home']);

Route::get('/about', [UmumController::class, 'about']);

Route::get('/posts', [PostController::class, 'posts']);

Route::get('/posts/{post:slug}', [PostController::class, 'showPost']);

Route::get('/categories/', [CategoryController::class, 'categories']);


Route::get('/login/', [AuthController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login/', [AuthController::class, 'authenticate']);


Route::get('/register/', [AuthController::class, 'register'])->middleware('guest');

Route::post('/register/', [AuthController::class, 'addUser']);


Route::post('/logout/', [AuthController::class, 'logout']);


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

// Routes Create Slug 
Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');


Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');




// Sudah Ditangani Oleh Post Model Dan Controller
/*
Route::get('/categories/{category:slug}', [CategoryController::class, 'category']);

Route::get('/authors/{author:username}', [UserController::class, 'author']);
*/