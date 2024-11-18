<?php


use App\Http\Controllers\AdminDashboardViewController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GetCartShoppingController;
use App\Http\Controllers\AttributeViewController;
use App\Http\Controllers\CategoryProductController;

use App\Http\Controllers\CategoryProductView;
use App\Http\Controllers\ProductView;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Auth\RegistController;
use App\Http\Controllers\Api\GetAllItemsShoppingCart;
use App\Http\Controllers\Api\PayMonneyController;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\DetailProductViewController;
use App\Http\Controllers\GetCartShoppingViewController;
use App\Http\Controllers\GetViewAllItemsShoppingCart;
use App\Http\Controllers\PayMonneyViewController;
use App\Http\Controllers\RatingViewController;
use App\Http\Controllers\ShoppingCartViewController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Api\PaymentByVNPayController;
use App\Http\Controllers\Api\ProfileCustomerViewController;
use App\Http\Controllers\Api\VnPayController;
use App\Http\Controllers\DetailViewBuyItems;
use App\Http\Controllers\HistotyViewBuyItems;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentByVnPay;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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


Route::get('category', [CategoryViewController::class, 'index']);
Route::get('/attribute', [AttributeViewController::class, 'showThemmeAttributeIndex'])->name('attribute');

// thực thi với theme dashboard
Route::get('/dashboard', [AdminDashboardViewController::class, 'showThemeDashBoard'])->name('index_dashboard');
Route::get('/get-orders', [AdminDashboardViewController::class, 'showIndexDashBoard'])->name('get-orders');
Route::get('view-detail/{id}', [AdminDashboardViewController::class, 'showViewDashBoard'])->name('get_view'); // hiển thị giao diện chi tiết view

// thực thi với chi tiết sản phẩm ở trang home
// Route::get('product_detail/{id_product}',[DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail");
Route::get('product/{id_slug}', [DetailProductViewController::class, 'showViewProductDetail'])->name("showdetail"); // hiển thị sản phẩm chi tiết

// hiển thị và thực thi với giỏ hàng
Route::get('/shopping-cart', [GetViewAllItemsShoppingCart::class, 'showAllItemsShoppingCart'])->name('showShoppingCart'); //hiển thị trang giỏ hàng


// test cái nha @phần này test chưa có sửa lại
Route::get('/product', [ShoppingCartViewController::class, 'showDemoNha'])->name('showItems'); // chỉ là demo thôi nè

//
// hiển thị thanh toán
Route::get('/pay-money', [PayMonneyViewController::class, 'showViewPayMoney'])->name('payMoney');





//Sanpham
Route::get('all-product', [ProductView::class, 'all_product'])->name('all_product');
Route::get('add-product', [ProductView::class, 'add_product'])->name('add_product');
Route::post('save-product', [ProductView::class, 'save_product'])->name('save_product');

Route::get('unactive-product/{product_id}', [ProductView::class, 'unactive_product'])->name('unactive_product');
Route::get('active-product/{product_id', [ProductView::class, 'active_product'])->name('active_product');
Route::get('edit-product/{product_id}', [ProductView::class, 'edit_product'])->name('edit_product');
Route::post('update-product/{product_id}', [ProductView::class, 'update_product'])->name('updatate_product');
Route::get('delete-product/{product_id}', [ProductView::class, 'delete_product'])->name('delete_product');


//Category_product
Route::get('/add-category-product', [CategoryProductView::class, 'add_category_product'])->name('add_category_product');
Route::get('/all-category-product', [CategoryProductView::class, 'all_category_product'])->name('all_category_product');
Route::post('save-category-product', [CategoryProductView::class, 'save_category_product'])->name('save_category_product');
//Route::get('/api/all-category-product', [CategoryProductController::class, 'api_all_category_product'])->name('api.all_category_product');

Route::get('unactive-category-product/{category_product_id}', [CategoryProductView::class, 'unactive_category_product'])->name('unactive_category_product');
Route::get('active-category-product/{category_product_id}', [CategoryProductView::class, 'active_category_product'])->name('active_category_product');
//Sua
Route::get('edit-category-product/{category_product_id}', [CategoryProductView::class, 'edit_category_product'])->name('edit_category_product');
Route::post('update-category-product/{category_product_id}', [CategoryProductView::class, 'update_category_product'])->name('update_category_product');
// //Xoa

Route::get('delete-category-product/{category_product_id}', [CategoryProductView::class, 'delete_category_product'])->name('delete_category_product');

Route::get('delete-category-product/{category_product_id}', [CategoryProductView::class, 'delete_category_product'])->name('delete_category_product');



Route::get('category', [CategoryViewController::class, 'index']);

// Route home
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/filter/products', [HomeController::class, 'filter'])->name('filter.products');
Route::post('/filter/price', [HomeController::class, 'filterByPrice'])->name('filter.price');
Route::post('/filter/sort', [HomeController::class, 'filterSort'])->name('filter.sort');
Route::post('/search/products', [HomeController::class, 'searchProducts']);
Route::post('/load-more/products', [HomeController::class, 'loadMore']);


//Route About

Route::get('/about', [AboutController::class, 'about'])->name('about');

// Route Event
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('create');
Route::post('/events/store', [EventController::class, 'store'])->name('events.store');
Route::delete('/events/{id}/delete', [EventController::class, 'destroy'])->name('deleteEvent');

// Route Review
// Hàm này mục đích chỉ để hiển thị trang chi tiết sản phẩm sẽ bị thay thế
Route::get('/product-detail', [ReviewController::class, 'index'])->name('product_detail');
Route::post('/submit-review', [ReviewController::class, 'saveReview']);
Route::delete('/reviews/{id}', [ReviewController::class, 'removeReview']);
Route::put('/reviews/{id}', [ReviewController::class, 'updateReview']);

// Route User
Route::get('/auth/forgot_password', [UserController::class, 'showForgotPassword'])->name('auth.password');
Route::post('/auth/forgot_password', [UserController::class, 'submitFormForgetPassword'])->name('auth.sumitReset');
Route::get('/auth/get_password/{customer}/{token}', [UserController::class, 'showGetPassword'])->name('auth.getPassword');
Route::post('/auth/get_password/{customer}/{token}', [UserController::class, 'submitGetPassword'])->name('auth.submitPassword');




Route::get('/register', [RegistController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegistController::class, 'register'])->name('index.register');


Route::get('/admin-rating',[RatingViewController::class, 'showViewRating']); // hiển thị view rating

Route::get('/about-me',[ProfileCustomerViewController::class, 'showViewProfileCustomer']); // hiển thị view chi tiết của khách hàng
Route::get('/history-buy',[HistotyViewBuyItems::class,'showViewHistoryBuyItems']); // hiển thị lịch sử mua hàng
Route::get('/detail-history/{id_order}',[DetailViewBuyItems::class, 'viewDetailBuyItems'])->name('order.details'); //hiển thị chi tiết sản phẩm đã mua


// Demo thanh toán
// Route::get('/testcai', [TestController::class, 'testcai']);
Route::get('/payment-buy-vnpay',[PaymentByVnPay::class, 'showViewPayByVNPay']);

