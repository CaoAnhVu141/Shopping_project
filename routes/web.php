<?php

use App\Http\Controllers\AdminDashboardViewController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\AttributeViewController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Auth\RegistController;
use App\Http\Controllers\Demo_OderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ShippingMethodController; // Đảm bảo bạn đã import đúng namespac

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
Route::get('/attribute',[AttributeViewController::class, 'showThemmeAttributeIndex']);

// thực thi với theme dashboard
Route::get('/dashboard',[AdminDashboardViewController::class, 'showThemeDashBoard'])->name('index_dashboard');
Route::get('/get-orders',[AdminDashboardViewController::class, 'showIndexDashBoard'])->name('get-orders');
Route::get('view-detail/{id}',[AdminDashboardViewController::class,'showViewDashBoard'])->name('get_view'); // hiển thị giao diện chi tiết view



Route::get('/attibute',[AttributeViewController::class, 'showThemmeAttributeIndex']);


Route::get('/demo',[RegistController::class, 'showRegistrationForm'])->name('register');
Route::post('/demo',[RegistController::class, 'register'])->name('index.register');

Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index'); // Trang hiển thị danh sách
Route::get('/favorites/{customerId}/{favoriteId}', [FavoriteController::class, 'show'])->name('favorites.show'); // Trang xem chi tiết

//Method
Route::get('/shipping-methods', [ShippingMethodController::class, 'indexView'])->name('shipping-methods.index');
Route::get('shipping-method/create', [ShippingMethodController::class, 'create'])->name('shipping-method.create');
Route::post('/shipping-methods', [ShippingMethodController::class, 'store'])->name('shipping-methods.store');
Route::get('/shipping-method/{id}/edit', [ShippingMethodController::class, 'edit'])->name('shipping-method.edit');
Route::put('/shipping-method/{id}', [ShippingMethodController::class, 'update'])->name('shipping-method.update');
Route::delete('/shipping-method/{id}', [ShippingMethodController::class, 'destroy'])->name('shipping-method.destroy');

