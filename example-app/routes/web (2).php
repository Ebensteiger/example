<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AdminAuthController;


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





Route::get('/', function () {
    return view('welcome');
});

Route::get('/example-app', [HomeController::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'create']);
Route::get('/categories', [CategoriesController::class, 'categories']);
Route::get('/categories/{id}', [CategoriesController::class, 'getSingleCategory']);
Route::get('/getcategories/{id}', [CategoriesController::class, 'getCategoryProducts']);
Route::put('/categories/{id}', [CategoriesController::class, 'update']);
Route::delete('/categories/{id}', [CategoriesController::class, 'delete']);



Route::post('/products', [ProductsController::class, 'create']);
Route::get('/products', [ProductsController::class, 'getAllProducts']);
Route::get('/products/{id}', [ProductsController::class, 'getSingleProduct']);
Route::get('/getproducts/{cat_id}', [ProductsController::class, 'getProductWithCategory']);
Route::post('/products/{id}', [ProductsController::class, 'updateProduct']);
Route::delete('/products/{id}', [ProductsController::class, 'delete']);



Route::get('/store/{id}', [StoreController::class, 'view']);
Route::get('/getstore/{categories_id}', [StoreController::class, 'getCategory']);
Route::get('/search', [StoreController::class, 'search']);



Route::post('/user/', [UserController::class, 'create']);
Route::get('/user', [UserController::class, 'user']);
Route::get('/user/{id}', [UserController::class, 'getSingleUser']);
Route::post('/user/{id}', [UserController::class, 'update']);



Route::post('/store/cart', [OrderController::class, 'create']);
Route::get('/store', [OrderController::class, 'order']);
Route::get('/store/{id}', [OrderController::class, 'getSingleOrder']);
Route::post('/store/cart/{id}', [OrderController::class, 'update']);
Route::post('/store/count', [OrderController::class, 'count']);
Route::post('/store/total', [OrderController::class, 'orderDashboard']);
Route::post('store/cart/{[id]}', [OrderController::class, 'updateBulk']);
Route::post('store/use/{id}', [OrderController::class, 'use']);
Route::post('store/using', [OrderController::class, 'using']);

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('admin', [AdminController::class, 'index']);
Route::post('/admin/signup', [AdminController::class, 'create']);
Route::get('/admin/{id}/dashboard', [AdminController::class, 'dashboard']);
// Route::post('admin/auth', [AdminController::class, 'auth']);
Route::get('admin/{id}/update', [AdminController::class, 'update']);
Route::get('admin/{id}/updatepassword', [AdminController::class, 'updatePassword']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
