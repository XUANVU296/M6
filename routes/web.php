<?php

use App\Http\Controllers\GroupController;
use App\Http\Controllers\UserController;
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
Route::get('/login-admin', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/checklogin', [\App\Http\Controllers\AuthController::class, 'checklogin'])->name('checklogin');
// Route::prefix('/')->middleware(['auth.check'])->group(function () {
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
    Route::resource('groups', \App\Http\Controllers\GroupController::class);
// });
Route::get('/detail/{id}', [GroupController::class, 'detail'])->name('group.detail');
Route::put('/group_detail/{id}', [GroupController::class, 'group_detail'])->name('group.group_detail');
Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
Route::delete('destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');
Route::resource('users', \App\Http\Controllers\UserController::class);


Route::group(['prefix' => '/'], function () {
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/editpass/{id}', [UserController::class, 'editpass'])->name('user.editpass');
    Route::put('/updatepass/{id}', [UserController::class, 'updatepass'])->name('user.updatepass');
    Route::get('/adminpass/{id}', [UserController::class, 'adminpass'])->name('user.adminpass');
    Route::put('/adminUpdatePass/{id}', [UserController::class, 'adminUpdatePass'])->name('user.adminUpdatePass');
});
