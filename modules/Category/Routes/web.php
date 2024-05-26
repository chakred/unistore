<?php

use Modules\Category\Http\Controllers\IndexController;
use Modules\Category\Http\Controllers\StoreController;
use Modules\Category\Http\Controllers\DeleteController;

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

Route::prefix('category')->group(function() {
    Route::get('/', IndexController::class)->name('category.index');
    Route::post('/create', StoreController::class)->name('category.store');
    Route::delete('/delete/{id}', DeleteController::class)->name('category.delete');
});
