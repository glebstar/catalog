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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/basket', [App\Http\Controllers\HomeController::class, 'basket'])->name('basket');
Route::post('/order', [App\Http\Controllers\HomeController::class, 'addOrder'])->name('order');
Route::get('/orders', [App\Http\Controllers\HomeController::class, 'orders'])->name('orders');
