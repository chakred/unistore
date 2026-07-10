<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontPageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CategoryGoodsController;
use App\Http\Controllers\CartController;
use Modules\Good\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::middleware('track.view')->group(function () {
    Route::get('/', FrontPageController::class);
    Route::get('/categories/{mark}/{model}', CategoriesController::class)->name('home.categories');
    Route::get('/category/{category}', CategoryGoodsController::class)->name('home.category');
    Route::get('/search', SearchController::class)->name('home.search');
});

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});

Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/', [CartController::class, 'store'])->name('store');
    Route::patch('/{good}/increase', [CartController::class, 'increase'])->name('increase');
    Route::patch('/{good}/decrease', [CartController::class, 'decrease'])->name('decrease');
    Route::delete('/{good}', [CartController::class, 'destroy'])->name('destroy');
});

Route::get('/dashboard', function () {
    return Inertia::render('Admin/Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
