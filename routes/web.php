<?php

use App\Http\Controllers\GroupController;
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
Route::get('/detail/{id}', [GroupController::class, 'detail'])->name('group.detail');
Route::put('/group_detail/{id}', [GroupController::class, 'group_detail'])->name('group.group_detail');
Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
Route::delete('destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');


