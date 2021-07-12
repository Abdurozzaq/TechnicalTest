<?php

use Illuminate\Support\Facades\Route;

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

/**
 * Guest Only Routes
 */
Route::middleware('guest')->group(function () {
  // Landing Page / Login Page
  Route::get('/', '\App\Http\Controllers\LandingController@landing');
});

Route::get('/dash', '\App\Http\Controllers\DashboardController@index');

// Category Management
Route::get('/category/create', '\App\Http\Controllers\CategoryController@createCategoryIndex');
Route::post('/category/create/send', '\App\Http\Controllers\CategoryController@createCategory');
Route::get('/category/list', '\App\Http\Controllers\CategoryController@categoryListIndex');
Route::post('/category/list/edit', '\App\Http\Controllers\CategoryController@editCategory');
Route::post('/category/list/delete', '\App\Http\Controllers\CategoryController@deleteCategory');

// Goods Management
Route::get('/goods/create', '\App\Http\Controllers\GoodsController@createGoodsIndex');
Route::post('/goods/create/send', '\App\Http\Controllers\GoodsController@createGoods');
Route::get('/goods/list', '\App\Http\Controllers\GoodsController@goodsListIndex');
Route::post('/goods/list/edit', '\App\Http\Controllers\GoodsController@editGoods');
Route::post('/goods/list/delete', '\App\Http\Controllers\GoodsController@deleteGoods');

// Calculator
Route::get('/calculator', '\App\Http\Controllers\CalculatorController@calculatorOngkir');

// Calculator
Route::get('/input-check', '\App\Http\Controllers\InputCheckController@index');