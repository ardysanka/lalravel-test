<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewUserController;
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



Route::get('/register', [ViewUserController::class, 'registerView'])->name('register');
Route::get('/login', [ViewUserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.process');
Route::post('/user/create', [UserController::class, 'register'])->name('user.register.process');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [ViewUserController::class, 'orderHistoryView'])->name('home');
    Route::post('/prepaid-balance', [OrderController::class, 'create'])->name('user.prepaid-balance.process');
    Route::get('/prepaid-balance', [ViewUserController::class, 'prepaidBalanceView'])->name('user.prepaid.balance');

    Route::post('/product-order', [OrderController::class, 'createProductOrder'])->name('user.product-order.process');
    Route::get('/product-order', [ViewUserController::class, 'productOrderView'])->name('user.product-order.view');

    Route::get('/order-success', [ViewUserController::class, 'successOrderView'])->name('user.order.success');
    Route::get('/order-history', [ViewUserController::class, 'orderHistoryView'])->name('user.order.history');
    Route::post('/payment/{id}', [OrderController::class, 'payment'])->name('user.payment.pay');
    Route::get('/payment/{id}', [ViewUserController::class, 'paymentView'])->name('user.payment.view');
    
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
