<?php

use App\Http\Controllers\AdminDashboardViewController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GetCartShoppingController;
use App\Http\Controllers\AttributeViewController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Auth\RegistController;
use App\Http\Controllers\Demo_OderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\Api\GetAllItemsShoppingCart;
use App\Http\Controllers\Api\PayMonneyController;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\DetailProductViewController;
use App\Http\Controllers\GetCartShoppingViewController;
use App\Http\Controllers\GetViewAllItemsShoppingCart;
use App\Http\Controllers\PayMonneyViewController;
use App\Http\Controllers\ShoppingCartViewController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FavoriteController;

use App\Http\Controllers\VerificationController;
use App\Mail\VerifyEmail;
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

// Route home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/filter/products', [HomeController::class, 'filter'])->name('filter.products');
Route::post('/filter/price', [HomeController::class, 'filterByPrice'])->name('filter.price');
Route::post('/filter/sort', [HomeController::class, 'filterSort'])->name('filter.sort');
Route::post('/search/products', [HomeController::class, 'searchProducts']);
Route::post('/load-more/products', [HomeController::class, 'loadMore']);




Route::get('/transaction', [App\Http\Controllers\TestController::class, 'testcai']);


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');




Route::get('/testcai', [App\Http\Controllers\TestController::class, 'testcai']);


Route::get('category', [CategoryViewController::class, 'index']);
Route::get('/attribute', [AttributeViewController::class, 'showThemmeAttributeIndex']);
// thực thi với theme dashboard
Route::get('/dashboard',[AdminDashboardViewController::class, 'showThemeDashBoard'])->name('index_dashboard');
Route::get('/get-orders',[AdminDashboardViewController::class, 'showIndexDashBoard'])->name('get-orders');
Route::get('view-detail/{id}',[AdminDashboardViewController::class,'showViewDashBoard'])->name('get_view'); // hiển thị giao diện chi tiết view


// đăng ký


Route::get('/attibute',[AttributeViewController::class, 'showThemmeAttributeIndex']);

// thực thi với chi tiết sản phẩm ở trang home
// Route::get('product_detail/{id_product}',[DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail");
Route::get('product/{id_slug}', [DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail"); // hiển thị sản phẩm chi tiết


// hiển thị và thực thi với giỏ hàng
Route::get('/shopping-cart',[GetViewAllItemsShoppingCart::class, 'showAllItemsShoppingCart'])->name('showShoppingCart'); //hiển thị trang giỏ hàng
// Route::get('/shopping-cart',[GetAllItemsShoppingCart::class, 'getAllItemsShoppingCart']); // lấy dữ liệu toàn bộ giỏ hàng @todo
Route::get('/get/cart',[GetCartShoppingController::class, 'getItemsCartShopping']); //thực thi trang giỏ hàng matter layout lấy dạng json
Route::put('/update-shopping-cart', [ShoppingCartController::class, 'updateQuantityAllItems'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::delete('delete/shopping-cart/{id_product}',[ShoppingCartController::class, 'deleteItemsShoppingCart']);

// test cái nha @phần này test chưa có sửa lại
Route::get('/product',[ShoppingCartViewController::class, 'showDemoNha'])->name('showItems'); // chỉ là demo thôi nè

// Route Event
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::delete('/events/{id}/delete', [EventController::class, 'destroy'])->name('deleteEvent');



Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites.index'); // Trang hiển thị danh sách
Route::get('/favorites/{customerId}/{favoriteId}', [FavoriteController::class, 'show'])->name('favorites.show'); // Trang xem chi tiết


Route::get('/register', [RegistController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistController::class, 'register'])->name('index.register');
Route::get('/verify/{token}', [RegistController::class, 'verify'])->name('verify');


Route::get('/shipping-methods', [ShippingMethodController::class, 'indexView'])->name('shipping-methods.index');

// Route User
Route::get('/auth/forgot_password', [UserController::class, 'showForgotPassword'])->name('auth.password');
Route::post('/auth/forgot_password', [UserController::class, 'submitFormForgetPassword'])->name('auth.sumitReset');
Route::get('/auth/get_password/{customer}/{token}', [UserController::class, 'showGetPassword'])->name('auth.getPassword');
Route::post('/auth/get_password/{customer}/{token}', [UserController::class, 'submitGetPassword'])->name('auth.submitPassword');

// Route Review
// Hàm này mục đích chỉ để hiển thị trang chi tiết sản phẩm sẽ bị thay thế
Route::get('/product-detail', [ReviewController::class, 'index'])->name('product_detail');


// Route Product
Route::get('/product/{productId}', [HomeController::class, 'getProductById']);

Route::post('/submit-review', [ReviewController::class, 'saveReview']);
Route::delete('/reviews/{id}', [ReviewController::class, 'removeReview']);
Route::put('/reviews/{id}', [ReviewController::class, 'updateReview']);


//
// hiển thị thanh toán
Route::get('/pay-money',[PayMonneyViewController::class, 'showViewPayMoney'])->name('payMoney');
// thực thị thanh toán
Route::get('/make-payment',[PayMonneyController::class, 'makePaymentAllItems']);

