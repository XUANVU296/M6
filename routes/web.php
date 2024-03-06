<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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

// Route::get('/a', function () {
//     return view('admin.index');
// });
Route::get('/admin', [AdminController::class, 'index'])->name('index');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/checklogin', [AuthController::class, 'checklogin'])->name('checklogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'auth'], function () {

    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('customers', \App\Http\Controllers\CustomerController::class);
    Route::resource('products', \App\Http\Controllers\ProductController::class);
});

    Route::resource('groups', \App\Http\Controllers\GroupController::class);
    Route::resource('orders', \App\Http\Controllers\OrderController::class);
    Route::delete('/orders/trash/{id}', [\App\Http\Controllers\OrderController::class, 'delete'])->name('orders.trash');
// });
Route::get('/detail/{id}', [GroupController::class, 'detail'])->name('group.detail');
Route::put('/group_detail/{id}', [GroupController::class, 'group_detail'])->name('group.group_detail');
Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
Route::delete('destroy/{id}', [GroupController::class, 'destroy'])->name('group.destroy');



Route::group(['prefix' => 'users'], function () {
    Route::get('/index', [UserController::class, 'index'])->name('users.index');
    Route::get('/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
    Route::get('/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::get('/editpass/{id}', [UserController::class, 'editpass'])->name('users.editpass');
    Route::put('/updatepass/{id}', [UserController::class, 'updatepass'])->name('users.updatepass');
    Route::get('/adminpass/{id}', [UserController::class, 'adminpass'])->name('users.adminpass');
    Route::put('/adminUpdatePass/{id}', [UserController::class, 'adminUpdatePass'])->name('users.adminUpdatePass');
});


Route::get('/change-password', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'showChangePasswordForm'])->name('changePassword');
Route::post('/change-password', [\App\Http\Controllers\Auth\ChangePasswordController::class, 'changePassword'])->name('changePassword.submit');
