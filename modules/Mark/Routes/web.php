<?php

use Modules\Mark\Http\Controllers\IndexController;
use Modules\Mark\Http\Controllers\StoreController;
use Modules\Mark\Http\Controllers\UpdateController;

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

Route::prefix('mark')->group(function() {
    Route::get('/', IndexController::class)->name('mark.index');
    Route::post('/create', StoreController::class)->name('mark.store');
    Route::put('/update/{id}', UpdateController::class)->name('mark.update');
});
