<?php

use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\CategoryViewController;
use App\Http\Controllers\Demo_OderController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;

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

// Route::get('/demo',TestController::class,'testcai');

Route::get('demo',[TestController::class,'testcai']);






Route::get('add-category-product', [CategoryProductController::class, 'add_category_product'])->name('add_category_product');
Route::get('all-category-product', [CategoryProductController::class, 'all_category_product'])->name('all_category_product');
Route::post('save-category-product', [CategoryProductController::class, 'save_category_product'])->name('save_category_product');

Route::get('unactive-category-product/{category_product_id}', [CategoryProductController::class, 'unactive_category_product'])->name('unactive_category_product');
Route::get('active-category-product/{category_product_id}', [CategoryProductController::class, 'active_category_product'])->name('active_category_product');
//Sua
Route::get('edit-category-product/{category_product_id}', [CategoryProductController::class, 'edit_category_product'])->name('edit_category_product');
Route::post('update-category-product/{category_product_id}', [CategoryProductController::class, 'update_category_product'])->name('update_category_product');
// //Xoa
Route::get('delete-category-product/{category_product_id}', [CategoryProductController::class, 'delete_category_product'])->name('delete_category_product');

Route::get('demo', [Demo_OderController::class, 'showData']);
Route::get('view', [Demo_OderController::class, 'showView'])->name("view");

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

<<<<<<< HEAD
// Route Product
Route::get('/product/{productId}', [HomeController::class, 'getProductById']);
=======
>>>>>>> trang_about_dotiendai
