<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NocticeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Laravel\Socialite\Facades\Socialite;

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

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/signup', [AuthController::class, 'signup']);
Route::post('/handle_signup', [AuthController::class, 'handle_signup']);


Route::get('/auth/google/redirect',[AuthController::class,'redirectGoogleAuth']);
Route::get('/auth/google/callback',[AuthController::class,'handleGoogleCallback']);

Route::get('/auth/facebook/redirect',[AuthController::class,'redirectFacebookAuth']);
Route::get('/auth/facebook/callback',[AuthController::class,'handleFacebookCallback']);

Route::middleware(['auth'])->group(function () {
  Route::get('/', [ProductController::class, 'index']);
  Route::resources([
    '/todos' => TodoController::class,
  ]);
  Route::resources([
    '/users' => UserController::class,
  ]);
  Route::resources([
    '/products' => ProductController::class,
  ]);
  Route::resources([
    '/categories' => CategoryController::class,
  ]);
  Route::resources([
    'admin/noctices' => NocticeController::class,
  ]);
  Route::get('/logout', [AuthController::class, 'logout']);
});