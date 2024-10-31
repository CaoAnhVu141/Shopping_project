<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

});

Route::get('categories', [CategoryProductController::class, 'api_all_category_product']);
// Route::apiResource('categories', CategoryProductController::class);
// Route::patch('categories/{id}/activate', [CategoryProductController::class, 'activate']);
// Route::patch('categories/{id}/deactivate', [CategoryProductController::class, 'deactivate']);
//Route::get('/category-products', [CategoryProductController::class, 'all_category_product_api']);
// Route::post('/category-products', [CategoryProductController::class, 'save_category_product_api']);


Route::get('/category', [CategoryController::class, 'index']);

