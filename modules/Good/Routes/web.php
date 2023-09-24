<?php

use Modules\Good\Http\Controllers\IndexController;
use Modules\Good\Http\Controllers\StoreController;

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


Route::prefix('good')->group(function() {
    Route::get('/', IndexController::class)->name('good.index');
    Route::post('/create', StoreController::class)->name('good.store');
});
