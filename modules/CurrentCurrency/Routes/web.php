<?php

use Modules\CurrentCurrency\Http\Controllers\IndexController;
use Modules\CurrentCurrency\Http\Controllers\StoreController;
use Modules\CurrentCurrency\Http\Controllers\UpdateController;
use Modules\CurrentCurrency\Http\Controllers\DeleteController;

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

Route::prefix('current-currency')->group(function() {
    Route::get('/', IndexController::class)->name('currentcurrency.index');
    Route::post('/create', StoreController::class)->name('currentcurrency.store');
    Route::put('/update/{id}', UpdateController::class)->name('currentcurrency.update');
    Route::delete('/delete/{id}', DeleteController::class)->name('currentcurrency.delete');
});
