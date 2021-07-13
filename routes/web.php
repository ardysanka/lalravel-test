<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', [ViewUserController::class, 'registerView'])->name('register');
Route::get('/login', [ViewUserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('user.login.process');
Route::post('/user/create', [UserController::class, 'register'])->name('user.register.process');
Route::post('/prepaid-balance', [OrderController::class, 'create'])->name('user.prepaid-balance.process');
Route::get('/prepaid-balance', [ViewUserController::class, 'prepaidBalanceView'])->name('user.prepaid.balance');
// Route::group(['prefix' => 'user'], function () {
//     Route::get('first', FirstIndex::class)->name('report.first.index');
//     // Route::get('second', SecondIndex::class)->name('report.second.index');
//     // Route::get('third', ThirdIndex::class)->name('report.third.index');
// });
// Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
