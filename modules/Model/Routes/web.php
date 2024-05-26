<?php

use Modules\Model\Http\Controllers\IndexController;
use Modules\Model\Http\Controllers\StoreController;
use Modules\Model\Http\Controllers\DeleteController;

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

Route::prefix('model')->group(function() {
    Route::get('/', IndexController::class)->name('model.index');
    Route::post('/create', StoreController::class)->name('model.store');
    Route::delete('/delete/{id}', DeleteController::class)->name('model.delete');
});
