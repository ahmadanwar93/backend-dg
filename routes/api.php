<?php

use App\Http\Controllers\ExtendedProductController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// For base task
Route::get('inventory', [ProductController::class, 'index']);
Route::get('inventory/{product}', [ProductController::class, 'show']);
Route::post('add-inventory', [ProductController::class, 'store']);
Route::delete('delete-inventory/{product}', [ProductController::class, 'destroy']);
Route::put('update-inventory/{product}', [ProductController::class, 'update']);

// For mid and senior task
Route::get('{userId}/inventory', [ExtendedProductController::class, 'index']);
Route::get('{userId}/inventory/{productId}', [ExtendedProductController::class, 'show']);
Route::post('{userId}/add-inventory', [ExtendedProductController::class, 'store']);
Route::delete('{userId}/delete-inventory/{productId}', [ExtendedProductController::class, 'destroy']);
Route::put('{userId}/update-inventory/{productId}', [ExtendedProductController::class, 'update']);

Route::get('{userId}/permissions', [PermissionController::class, 'show']);
Route::put('{userId}/permissions', [PermissionController::class, 'update']);