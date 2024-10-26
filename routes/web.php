<?php

use App\Http\Controllers\AttributeViewController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Auth\RegistController;
use App\Http\Controllers\Demo_OderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


// Route::get('/demo',TestController::class,'testcai');
Route::get('demo',[TestController::class,'testcai']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('category', [CategoryViewController::class, 'index']);


Route::get('/attibute',[AttributeViewController::class, 'showThemmeAttributeIndex']);


Route::get('/demo',[RegistController::class, 'showRegistrationForm'])->name('register');
Route::post('/demo',[RegistController::class, 'register'])->name('index.register');

Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index'); // Trang hiển thị danh sách
Route::get('/favorites/{customerId}/{favoriteId}', [FavoriteController::class, 'show'])->name('favorites.show'); // Trang xem chi tiết

