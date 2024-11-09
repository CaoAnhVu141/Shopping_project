<?php


use App\Http\Controllers\Api\AtributeController;
use App\Http\Controllers\Api\AttributeController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\GetAllItemsShoppingCart;
use App\Http\Controllers\Api\GetCartShoppingController;
use App\Http\Controllers\Api\PayMonneyController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\ShoppingCartController;
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
Route::post('/cart/add/{Idproduct}', [ShoppingCartController::class, 'addToCartShopping']); // thêm sản phẩm vào giỏ hàng
// Route::post('/cart/update/{Idproduct}', [ShoppingCartController::class, 'updateItemsShoppingCart']);  // cập nhập số lượng giỏ hàng
// Route::get('/cart/update/{Idproduct}', [ShoppingCartController::class, 'updateItemsShoppingCart']); @todo đang gặp lõi
//
Route::get('/get-product/{id_product}', [ProductController::class, 'getItemsProduct']); // sản phẩm chi tiết @todo làm lại sau

// thực thị thanh toán
// Route::get('/make-payment',[PayMonneyController::class, 'makePaymentAllItems'])->name('makepaymoney');

Route::get('/admin-rating',[RatingController::class,'getAllRatings']); //hiên thị dữ liệu rating
Route::delete('/delete-admin-rating/{id}',[RatingController::class, 'deleteItemsReview']); // thực thi xoá dữ liệu
Route::get('/search-rating',[RatingController::class, 'fullTextSearchRatings'])->name('fulltextsearchRating');