<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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



Route::middleware('auth', 'isAdmin')->group( function(){
    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.index');
    Route::get('admin/orders', [OrderController::class, 'index'])->name('order.index');
    Route::patch('admin/order/{order}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('admin/order/{order}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::resource('admin/product', ProductController::class)->except('show');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::any('{any}', function () {
    return view('welcome');
})->where('any', '.*');
