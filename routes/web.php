<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserStoreController;

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

Route::get('/', function () {
    return view('auth.login');
});

// fixme - should add the 'verified' in the middleware
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [AppController::class, 'index'])->name('app.index');
// });

// Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');

    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
// });

// Route::middleware('auth')->group(function () {
    Route::get('/store', [UserStoreController::class, 'index'])->name('store.index');
    Route::post('/store', [UserStoreController::class, 'updateStore'])->name('store.update');
    Route::post('/store/logo', [UserStoreController::class, 'updateLogo'])->name('store.logo.update');
    // logo and cover to come later
// });

// Route::middleware('auth')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products', [ProductController::class, 'add'])->name('product.add');
    Route::post('/product/{id}', [ProductController::class, 'update'])->name('product.update');
// });

// Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}/accept', [OrderController::class, 'acceptOrder'])->name('orders.order.accept');
});

// Route::get('/welcome', function () {
//     return view('welcome');
// });

require __DIR__ . '/auth.php';
