<?php
use App\Http\Controllers\Api\AtributeController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GetAllItemsShoppingCart;
use App\Http\Controllers\Api\GetCartShoppingController;
use App\Http\Controllers\Api\HistoryBuyItems;
use App\Http\Controllers\Api\PayMonneyController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ShoppingCartController;
use App\Http\Controllers\Api\VnPayController;
use App\Http\Controllers\Api\StatisticalOrderController;
use App\Http\Controllers\Api\StatisticalProductController;

use App\Http\Controllers\RatingViewController;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CategoryProductView;

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

Route::get('category', [CategoryProductView::class, 'api_all_category_product']);
Route::get('products', [ProductController::class, 'getAllProducts']);
Route::post('toggle-product-status/{id}', [ProductController::class, 'toggleStatus']);
Route::delete('delete-product/{id}', [ProductController::class, 'delete']);


//Route::get('categories', [CategoryProductController::class, 'api_all_category_product']);
// Route::apiResource('categories', CategoryProductController::class);
// Route::patch('categories/{id}/activate', [CategoryProductController::class, 'activate']);
// Route::patch('categories/{id}/deactivate', [CategoryProductController::class, 'deactivate']);
//Route::get('/category-products', [CategoryProductController::class, 'all_category_product_api']);
// Route::post('/category-products', [CategoryProductController::class, 'save_category_product_api']);


Route::get('/category', [CategoryController::class, 'index']);

// Thực thi với attribute
Route::get('/attribute', [AttributeController::class, 'getDataJson']);
Route::delete('/attribute/{id}', [AttributeController::class, 'deteleDataAttribute']);
Route::get('/attribute/create', [AttributeController::class, 'showCreateAttribute']);
Route::post('/attribute/create', [AttributeController::class, 'createDataAttribute']);
Route::get('attribute/update/{id}', [AttributeController::class, 'showEditAttribute']);
Route::put('attribute/update/{id}', [AttributeController::class, 'updateDataAttribute']);
// tìm kiếm
Route::get('attribute/search', [AttributeController::class, 'searchAttribute']);

// thực thi với dashboard
Route::get('/dashboard', [DashboardController::class, 'getItemDashBoard']);  //hiện thị dữ liệu dashboard
Route::get('/get-orders', [DashboardController::class, 'getAllItemDashboard']); // lấy toàn bộ danh sách dashboard
Route::put('/update/dashboard-status/{id}', [DashboardController::class, 'updateStatusOrderDashBoard']);   //@todo     // cập nhật trang thái status
// Route::get('view-detail_items/{id}',[DashboardController::class, 'getViewItemDashboard']); @todo
Route::get('/dashboard/search', [DashboardController::class, 'findValueDashBoard']); // tìm kiếm dữ liệu dashboard

// thực thi với giỏ hàng và trang giỏ hàng
Route::get('/get-cart', [GetCartShoppingController::class, 'getItemsCartShopping']); //thực thi trang giỏ hàng matter layout lấy dạng json
Route::post('/cart-add/{Idproduct}', [ShoppingCartController::class, 'addToCartShopping']); // thêm sản phẩm vào giỏ hàng
// Route::put('/update-shopping-cart', [ShoppingCartController::class, 'updateQuantityAllItems'])->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
Route::put('/update-cart', [ShoppingCartController::class, 'updateQuantityAllItems']);
Route::delete('delete-cart/{id_product}', [ShoppingCartController::class, 'deleteItemsShoppingCart']);
//
Route::get('/get-product/{id_product}', [ProductController::class, 'getItemsProduct']); // sản phẩm chi tiết @todo làm lại sau

// thực thị thanh toán
// Route::get('/make-payment',[PayMonneyController::class, 'makePaymentAllItems'])->name('makepaymoney');
Route::get('/make-payment', [PayMonneyController::class, 'makePaymentAllItems']);
Route::post('/order-items',[PayMonneyController::class, 'paymentAllItems']); //tiến hành đặt hàng
//Thực thi Rating bên admin
Route::get('/admin-rating',[RatingController::class,'getAllRatings']); //hiên thị dữ liệu rating
Route::delete('/delete-admin-rating/{id}',[RatingController::class, 'deleteItemsReview']); // thực thi xoá dữ liệu
Route::get('/search-rating',[RatingController::class, 'fullTextSearchRatings'])->name('fulltextsearchRating');

//Lịch sử mua hàng
Route::get('/history-buy-items',[HistoryBuyItems::class,'getAllBuyItemsHistory']); //danh sách lịch sử mua hàng
Route::get('/detail-history-items/{id_order}',[HistoryBuyItems::class,'getOrderHistoryDetails']); // chi tiết sản phẩm đã mua
Route::post('/cancel-status-items/{id_order}',[HistoryBuyItems::class, 'cancelOrderItems']); // Huỷ đơn hàng khi không mua nữa
Route::get('/search-history-items',[HistoryBuyItems::class,'fullTextSearchHistoryItems']); // tìm kiếm cho lịch sử mua hàng




//Demo thanh toán bằng api VNPAY
Route::post('/payment-vnpay', [VnPayController::class, 'createPayment'])->name('create.payment');
Route::get('/vnpay-return', function (Request $request) {
    return response()->json(['status' => 'success', 'message' => 'VNPAY Return is working!'])
        ->header('ngrok-skip-browser-warning', 'true');
});

//Thống kê cho bên admin
Route::get('/product-staticital',[StatisticalProductController::class, 'productStatistical']); //thống kê sản phẩm
Route::get('/out-stock-product',[StatisticalProductController::class, 'outOfStockProduct']); //thống kê sản phẩm nào gần hết
Route::get('/top-sell-product',[StatisticalProductController::class,'bestSellProduct']); // thống kê top 10 sản phẩm bán chạy nhất
Route::get('/order-by-status',[StatisticalOrderController::class, 'orderByStatus']); // thống kê theo trạng thái sản phẩm

// Biểu đồ theo tháng
Route::get('/revenue-by-month',[StatisticalOrderController::class, 'revenueByMonth']); // thóng kê theo tháng
Route::get('/revenue-by-days',[StatisticalOrderController::class, 'revenueByDays']); //thống kê theo ngày



