<?php

use App\Http\Controllers\Api\AtributeController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\CategoryController;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FavoriteApiController;

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

Route::get('/category', [CategoryController::class, 'index']);

Route::get('/attribute',[AttributeController::class,'getDataJson']);
Route::delete('/attribute/{id}',[AttributeController::class, 'deteleDataAttribute']);

Route::get('/attribute/create',[AttributeController::class, 'showCreateAttribute']);

Route::get('/favorites/{customerId}', [FavoriteApiController::class, 'index']); // Lấy danh sách yêu thích
Route::post('/favorites', [FavoriteApiController::class, 'store']); // Thêm sản phẩm yêu thích
Route::get('/favorites/{customerId}/{favoriteId}', [FavoriteApiController::class, 'show']); // Xem sản phẩm yêu thích
Route::delete('/favorites/{customerId}/{favoriteId}', [FavoriteApiController::class, 'destroy']); // Xóa sản phẩm yêu thích
