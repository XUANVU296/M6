<?php

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

// Route::get('/', function () {
//     return view('index');
// });
Route::resource('categories', \App\Http\Controllers\CategoryController::class);
Route::resource('customers', \App\Http\Controllers\CustomerController::class);
Route::resource('products', \App\Http\Controllers\ProductController::class);
Route::resource('groups', \App\Http\Controllers\GroupController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);


