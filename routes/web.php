<?php

use App\Http\Controllers\AffiliateLinksController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

// 

Route::get('/', function () {
    return view('main');
});

Route::view('login', 'login')->name('login');

Route::view('main','main');
// Route::view('admin','admin');
// Route::view('/admin.users', 'admin.users');
// Route::view('/admin.products', 'admin.products');


Route::get('/register',[RegisterController::class,'index'])->name('register.index');
Route::post('/register/store', [RegisterController::class, 'store'])->name('register.store');
Route::post('/main', [RegisterController::class, 'login'])->name('register.login');

Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
Route::post('/admin/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::get('/admin/products', [AdminController::class, 'manageProducts'])->name('admin.products');
    Route::get('/admin/affiliate_links', [AdminController::class, 'manageAffiliateLinks'])->name('admin.affiliate_links');
    Route::get('/admin/orders', [AdminController::class, 'checkOrders'])->name('admin.orders');
    Route::get('/admin/transactions', [AdminController::class, 'Transactions'])->name('admin.transactions');
    Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

});

Route::get('/admin.users', [UsersController::class, 'index'])->name('admin.users');
Route::get('/admin.products', [ProductController::class, 'index'])->name('admin.products');
Route::get('/admin.affiliate_links', [AffiliateLinksController::class, 'index'])->name('admin.affiliate_links');
Route::get('/admin.orders', [OrdersController::class, 'index'])->name('admin.orders');
Route::get('/admin.transactions', [TransactionsController::class, 'index'])->name('admin.transactions');