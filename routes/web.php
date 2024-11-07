<?php

use App\Http\Controllers\AdminDashboardViewController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GetCartShoppingController;
use App\Http\Controllers\AttributeViewController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Demo_OderController;
use App\Http\Controllers\Api\GetAllItemsShoppingCart;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\DetailProductViewController;
use App\Http\Controllers\GetCartShoppingViewController;
use App\Http\Controllers\GetViewAllItemsShoppingCart;
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

// thực thi với chi tiết sản phẩm ở trang home
// Route::get('product_detail/{id_product}',[DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail");
Route::get('product/{id_slug}', [DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail"); // hiển thị sản phẩm chi tiết

// hiển thị và thực thi với giỏ hàng
Route::get('/shopping-cart',[GetViewAllItemsShoppingCart::class, 'showAllItemsShoppingCart'])->name('showShoppingCart'); //hiển thị trang giỏ hàng
// Route::get('/shopping-cart',[GetAllItemsShoppingCart::class, 'getAllItemsShoppingCart']); // lấy dữ liệu toàn bộ giỏ hàng @todo
Route::get('/get/cart',[GetCartShoppingController::class, 'getItemsCartShopping']); //thực thi trang giỏ hàng matter layout lấy dạng json
Route::get('add_shopping_cart/{id_product}',[ShoppingCartViewController::class, 'showViewModelCart']); // thêm giá trị vào giỏ hàng
Route::put('/update-shopping-cart', [ShoppingCartController::class, 'updateQuantityAllItems'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::delete('delete/shopping-cart/{id_product}',[ShoppingCartController::class, 'deleteItemsShoppingCart']);

// test cái nha @phần này test chưa có sửa lại
Route::get('/product',[ShoppingCartViewController::class, 'showDemoNha'])->name('showItems'); // chỉ là demo thôi nè

//
