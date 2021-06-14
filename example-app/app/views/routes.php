<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;




Route::get('/' , function()
{
  return view('welcome');
});

Route::get('/example-app', [HomeContoller::class, 'index']);
Route::post('/categories', [CategoriesController::class, 'create']);
