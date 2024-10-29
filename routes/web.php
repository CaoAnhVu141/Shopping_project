<?php

use App\Http\Controllers\AdminDashboardViewController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\AttributeViewController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Demo_OderController;
use App\Http\Controllers\ShoppingCartViewController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

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

Route::get('/testcai', [App\Http\Controllers\TestController::class, 'testcai']);
// Route::get('demo',[Demo_OderController::class,'showData']);
// Route::get('view',[Demo_OderController::class,'showView'])->name("view");

Route::get('category', [CategoryViewController::class, 'index']);
Route::get('/attribute',[AttributeViewController::class, 'showThemmeAttributeIndex']);

// thực thi với theme dashboard
Route::get('/dashboard',[AdminDashboardViewController::class, 'showThemeDashBoard'])->name('index_dashboard');
Route::get('/get-orders',[AdminDashboardViewController::class, 'showIndexDashBoard'])->name('get-orders');
Route::get('view-detail/{id}',[AdminDashboardViewController::class,'showViewDashBoard'])->name('get_view'); // hiển thị giao diện chi tiết view

// hiển thị và thực thi với giỏ hàng
Route::get('shopping-cart',[ShoppingCartViewController::class, 'showViewShopping_Cart']); //hiển thị trang giỏ hàng
Route::get('add_shopping_cart/{id_product}',[ShoppingCartViewController::class, 'showViewModelCart']);
// test cái nha
Route::get('/product',[ShoppingCartViewController::class, 'showDemoNha'])->name('showItems');
