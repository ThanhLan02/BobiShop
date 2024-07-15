<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Middleware\AuthenticateMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// authentication
Route::get('/', [HomeController::class, 'index'])->name('Home.index');
Route::get('login', [AuthController::class, 'login'])->name('auth.login');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('dologin', [AuthController::class, 'dologin'])->name('auth.dologin');
Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
// admin
Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.index')->middleware(AuthenticateMiddleware::class);
// admin-brand
Route::get('brand', [BrandsController::class, 'index'])->name('admin.brand')->middleware(AuthenticateMiddleware::class);
Route::get('brandcreate', [BrandsController::class, 'brandcreate'])->name('admin.brandcreate')->middleware(AuthenticateMiddleware::class);
Route::post('brandstore', [BrandsController::class, 'brandstore'])->name('admin.brandstore')->middleware(AuthenticateMiddleware::class);
Route::get('brandupdate/{id}', [BrandsController::class, 'brandupdate'])->where(['id' => '[0-9]+'])->name
('admin.brandupdate')->middleware(AuthenticateMiddleware::class);
Route::post('branddoupdate/{id}', [BrandsController::class, 'branddoupdate'])->where(['id' => '[0-9]+'])->name
('admin.branddoupdate')->middleware(AuthenticateMiddleware::class);
Route::delete('branddelete/{id}', [BrandsController::class, 'branddelete'])->where(['id' => '[0-9]+'])->name
('admin.branddelete')->middleware(AuthenticateMiddleware::class);

// admin-category
Route::get('category', [CategoryController::class, 'index'])->name('admin.category')->middleware(AuthenticateMiddleware::class);
Route::get('categorycreate', [CategoryController::class, 'categorycreate'])->name('admin.categorycreate')->middleware(AuthenticateMiddleware::class);
Route::post('categorystore', [CategoryController::class, 'categorystore'])->name('admin.categorystore')->middleware(AuthenticateMiddleware::class);
Route::get('categoryupdate/{id}', [CategoryController::class, 'categoryupdate'])->where(['id' => '[0-9]+'])->name
('admin.categoryupdate')->middleware(AuthenticateMiddleware::class);
Route::post('categorydoupdate/{id}', [CategoryController::class, 'categorydoupdate'])->where(['id' => '[0-9]+'])->name
('admin.categorydoupdate')->middleware(AuthenticateMiddleware::class);
Route::delete('categorydelete/{id}', [CategoryController::class, 'categorydelete'])->where(['id' => '[0-9]+'])->name
('admin.categorydelete')->middleware(AuthenticateMiddleware::class);

// admin-products
Route::get('product', [ProductController::class, 'index'])->name('admin.product')->middleware(AuthenticateMiddleware::class);
Route::get('productcreate', [ProductController::class, 'productcreate'])->name('admin.productcreate')->middleware(AuthenticateMiddleware::class);
Route::post('productstore', [ProductController::class, 'productstore'])->name('admin.productstore')->middleware(AuthenticateMiddleware::class);
Route::get('productupdate/{id}', [ProductController::class, 'productupdate'])->where(['id' => '[0-9]+'])->name
('admin.productupdate')->middleware(AuthenticateMiddleware::class);
Route::post('productdoupdate/{id}', [ProductController::class, 'productdoupdate'])->where(['id' => '[0-9]+'])->name
('admin.productdoupdate')->middleware(AuthenticateMiddleware::class);
Route::delete('productdelete/{id}', [ProductController::class, 'productdelete'])->where(['id' => '[0-9]+'])->name
('admin.productdelete')->middleware(AuthenticateMiddleware::class);
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});


