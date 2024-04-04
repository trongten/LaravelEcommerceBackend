<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Middleware\CheckRole;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user/signup', [AuthController::class,'signup']);
Route::post('/user/login', [AuthController::class,'login']);
Route::middleware('auth:api')->group(function(){
    Route::get('/user/me',[AuthController::class,'getInfo']);

   
    Route::post('/admin/orders' ,[OrderController::class,'add']);
    Route::get('/admin/orders' ,[OrderController::class,'index']);
    Route::put('/admin/orders/{id}' ,[OrderController::class,'update']);
    Route::put('/admin/orders/state/{id}' ,[OrderController::class,'updateStateOrder']);
    Route::delete('/admin/orders/{id}' ,[OrderController::class,'destroy']);

    Route::middleware('checkrole')->group(function(){

        Route::get('/admin/products' ,[ProductController::class,'index']);
        Route::post('/admin/products' ,[ProductController::class,'add']);
        Route::put('/admin/products/{id}' ,[ProductController::class,'update']);
        Route::delete('/admin/products/{id}' ,[ProductController::class,'destroy']);
            
        Route::get('/admin/product_categories' ,[CategoriesController::class,'index']);
        Route::post('/admin/product_categories' ,[CategoriesController::class,'add']);
        Route::put('/admin/product_categories/{id}' ,[CategoriesController::class,'update']);
        Route::delete('/admin/product_categories/{id}' ,[CategoriesController::class,'destroy']);

        

    });
    

});





