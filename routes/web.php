<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\ImageController;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Http;
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
Route::get('register', [AuthController::class, 'register'])->name('auth.register');
Route::post('registerSubmit', [AuthController::class, 'registerSubmit'])->name('auth.registerSubmit');
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

Route::put('/update-status-product/{id}', [ProductController::class, 'updateProductStatus'])->where(['id' => '[0-9]+'])->name
('admin.updateProductStatus')->middleware(AuthenticateMiddleware::class);

// admin-users
Route::get('users', [UsersController::class, 'index'])->name('admin.users')->middleware(AuthenticateMiddleware::class);
Route::get('userscreate', [UsersController::class, 'userscreate'])->name('admin.userscreate')->middleware(AuthenticateMiddleware::class);
Route::post('usersstore', [UsersController::class, 'usersstore'])->name('admin.usersstore')->middleware(AuthenticateMiddleware::class);
Route::get('usersupdate/{id}', [UsersController::class, 'usersupdate'])->where(['id' => '[0-9]+'])->name
('admin.usersupdate')->middleware(AuthenticateMiddleware::class);
Route::post('usersdoupdate/{id}', [UsersController::class, 'usersdoupdate'])->where(['id' => '[0-9]+'])->name
('admin.usersdoupdate')->middleware(AuthenticateMiddleware::class);
Route::delete('usersdelete/{id}', [UsersController::class, 'usersdelete'])->where(['id' => '[0-9]+'])->name
('admin.usersdelete')->middleware(AuthenticateMiddleware::class);

Route::put('/update-status-users/{id}', [UsersController::class, 'updateUsersStatus'])->where(['id' => '[0-9]+'])->name
('admin.updateUsersStatus')->middleware(AuthenticateMiddleware::class);

// admin-images
Route::get('image', [ImageController::class, 'index'])->name('admin.image')->middleware(AuthenticateMiddleware::class);
Route::get('imagecreate', [ImageController::class, 'imagecreate'])->name('admin.imagecreate')->middleware(AuthenticateMiddleware::class);
Route::post('imagestore', [ImageController::class, 'imagestore'])->name('admin.imagestore')->middleware(AuthenticateMiddleware::class);
Route::get('imageupdate/{id}', [ImageController::class, 'imageupdate'])->where(['id' => '[0-9]+'])->name
('admin.imageupdate')->middleware(AuthenticateMiddleware::class);
Route::post('imagedoupdate/{id}', [ImageController::class, 'imagedoupdate'])->where(['id' => '[0-9]+'])->name
('admin.imagedoupdate')->middleware(AuthenticateMiddleware::class);
Route::delete('imagedelete/{id}', [ImageController::class, 'imagedelete'])->where(['id' => '[0-9]+'])->name
('admin.imagedelete')->middleware(AuthenticateMiddleware::class);

// province routes
Route::get('/provinceapi', [UsersController::class, 'provinceapi'])->name('admin.provinceapi')->middleware(AuthenticateMiddleware::class);

Route::get('/get-districts/{province_id}', [UsersController::class, 'getDistricts'])->name('get-districts');
Route::get('/get-wards/{district_id}', [UsersController::class, 'getWards'])->name('get-wards');
Route::get('/get-ward-name/{ward_id}', [UsersController::class, 'getWardName'])->name('get-ward-name');
// Route::get('/api/provinces', function () {
//     $response = Http::get('https://provinces.open-api.vn/api/p');
//     return $response->body();
// });

// Route::get('/api/provinces/{provinceCode}/districts', function ($provinceCode) {
//     $response = Http::get("https://provinces.open-api.vn/api/p/$provinceCode/d");
//     return $response->body();
// });

// Route::get('/api/provinces/{provinceCode}/districts/{districtCode}/wards', function ($provinceCode, $districtCode) {
//     $response = Http::get("https://provinces.open-api.vn/api/p/$provinceCode/d/$districtCode/w");
//     return $response->body();
// });
// admin-orders
Route::get('orders', [OrdersController::class, 'index'])->name('admin.orders')->middleware(AuthenticateMiddleware::class);
Route::post('ordersdoupdate/{id}', [OrdersController::class, 'ordersdoupdate'])->where(['id' => '[0-9]+'])->name
('admin.ordersdoupdate')->middleware(AuthenticateMiddleware::class);
Route::delete('orderscancel/{id}', [OrdersController::class, 'orderscancel'])->where(['id' => '[0-9]+'])->name
('admin.orderscancel')->middleware(AuthenticateMiddleware::class);
Route::get('get-order-details/{id}', [OrdersController::class, 'getOrderDetails'])->where(['id' => '[0-9]+'])->name
('admin.getOrderDetails')->middleware(AuthenticateMiddleware::class);;

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

// User
Route::get('product_detail/{id}', [HomeController::class, 'product_detail'])->where(['id' => '[0-9]+'])->name
('home.product_detail');
Route::get('cart', [CartController::class, 'index'])->name
('user.cart')->middleware(AuthenticateMiddleware::class);
Route::get('checkout', [CartController::class, 'checkout'])->name
('user.checkout')->middleware(AuthenticateMiddleware::class);
Route::post('/add-to-cart/{id}', [CartController::class, 'AddToCart'])->where(['id' => '[0-9]+'])->name
('single-add-to-cart')->middleware(AuthenticateMiddleware::class);
Route::post('/add-many-cart/{id}', [CartController::class, 'AddManyCart'])->where(['id' => '[0-9]+'])->name
('many-add-to-cart')->middleware(AuthenticateMiddleware::class);
Route::post('deletesinglecart/{id}', [CartController::class, 'deletesinglecart'])->where(['id' => '[0-9]+'])->name
('user.deletesinglecart')->middleware(AuthenticateMiddleware::class);
Route::post('deleteallcart', [CartController::class, 'deleteallcart'])->where(['id' => '[0-9]+'])->name
('user.deleteallcart')->middleware(AuthenticateMiddleware::class);
Route::post('updatequantitycart/{id}', [CartController::class, 'updatequantitycart'])->where(['id' => '[0-9]+'])->name
('user.updatequantitycart')->middleware(AuthenticateMiddleware::class);
Route::post('payment_cash', [CartController::class, 'payment_cash'])->where(['id' => '[0-9]+'])->name
('user.payment_cash')->middleware(AuthenticateMiddleware::class);

Route::get('order_list', [CartController::class, 'order_list'])->name('user.order_list')->middleware(AuthenticateMiddleware::class);

Route::get('tracking_order/{id}', [CartController::class, 'tracking_order'])->where(['id' => '[0-9]+'])->name
('user.tracking_order')->middleware(AuthenticateMiddleware::class);
Route::post('ordercomfirm/{id}', [OrdersController::class, 'ordercomfirm'])->where(['id' => '[0-9]+'])->name
('user.ordercomfirm')->middleware(AuthenticateMiddleware::class);
// Route::delete('userordercancel/{id}', [OrdersController::class, 'userordercancel'])->where(['id' => '[0-9]+'])->name
// ('user.userordercancel')->middleware(AuthenticateMiddleware::class);
Route::get('allproduct', [UserController::class, 'allproduct'])->name('user.allproduct');
Route::get('productbycate/{id}', [UserController::class, 'productbycate'])->where(['id' => '[0-9]+'])->name
('user.productbycate');
Route::get('productbycatename/{name}', [UserController::class, 'productbycatename'])->name
('user.productbycatename');
Route::get('/search', [UserController::class, 'search'])->name('user.search');



Route::post('paymentmomo', [CartController::class, 'paymentmomo'])->name('user.paymentmomo')->middleware(AuthenticateMiddleware::class);
Route::get('thanksfororder', [CartController::class, 'thanksfororder'])->name
('user.thanksfororder')->middleware(AuthenticateMiddleware::class);
Route::post('/payment', [CartController::class, 'pay'])->name('payment');
Route::get('/payment/return', [CartController::class, 'return'])->name('payment.return');
Route::post('/payment/notify', [CartController::class, 'notify'])->name('payment.notify');
Route::post('/submitreview', [UserController::class, 'submitreview'])->name('user.submitreview')->middleware(AuthenticateMiddleware::class);