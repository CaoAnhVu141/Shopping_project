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
use App\Http\Controllers\VerificationController;
use App\Mail\VerifyEmail;

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

Route::get('/transaction', [App\Http\Controllers\TestController::class, 'testcai']);
// Route::get('demo',[Demo_OderController::class,'showData']);
// Route::get('view',[Demo_OderController::class,'showView'])->name("view");

Route::get('category', [CategoryViewController::class, 'index']);
Route::get('/attribute', [AttributeViewController::class, 'showThemmeAttributeIndex']);

// thực thi với theme dashboard
Route::get('/dashboard', [AdminDashboardViewController::class, 'showThemeDashBoard'])->name('index_dashboard');
Route::get('/get-orders', [AdminDashboardViewController::class, 'showIndexDashBoard'])->name('get-orders');
Route::get('view-detail/{id}', [AdminDashboardViewController::class, 'showViewDashBoard'])->name('get_view'); // hiển thị giao diện chi tiết view

// đăng ký
Route::get('/register', [RegistController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistController::class, 'register'])->name('index.register');
Route::get('/verify/{token}', [RegistController::class, 'verify'])->name('verify');

//chi tiết sản phẩm
Route::get('product/{id_slug}', [DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail"); // hiển thị sản phẩm chi tiết