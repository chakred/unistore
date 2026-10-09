<?php

use Modules\Orders\Http\Controllers\IndexController;
use Modules\Orders\Http\Controllers\UpdateController;
use Modules\Orders\Http\Controllers\SearchGoodsController;

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

Route::prefix('orders')->group(function() {
    Route::get('/', IndexController::class)->name('order.index');
    Route::get('/goods-search', SearchGoodsController::class)->name('order.goods.search');
    Route::put('/update/{order}', UpdateController::class)->name('order.update');
});
