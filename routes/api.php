<?php

use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\V1\StoreController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['namespace' => 'App\Http\Controllers\Api'], function (){
//     Route::apiResource('customers', CustomerController::class);
//     Route::apiResource('invoices', InvoiceController::class);
// });


//ROUTES THAT DONT NEED AUTH
Route::post('/signup', [UserController::class, 'signup']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/forgot-password', [UserController::class, 'forgot_password']);

//ROUTES THAT NEED AUTH AND VERIFIED EMAIL
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [UserController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::post('/profile', [UserController::class, 'updateProfile']);
    Route::get('/profile/avatar', [UserController::class, 'avatar']);
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar']);
    Route::post('/profile/password', [UserController::class, 'updatePassword']);

    Route::get('/store', [StoreController::class, 'store']);
    Route::post('/store', [StoreController::class, 'updateStore']);
    // Route::get('/store/logo', [StoreController::class, 'logo']);
    // Route::post('/store/logo', [StoreController::class, 'updateLogo']);
});

// Route::group(['middleware' => ['auth:sanctum', verifiedUser::class]], function () {
// Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
//     Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
//     Route::post('profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
//     Route::get('profile/avatar', [ProfileController::class, 'getavatar'])->name('profile.avatar');
// })->middleware(['auth:sanctum', 'verified']);

//ROUTES THAT NEED ONLY AUTH
// Route::group(['middleware' => ['auth:sanctum']], function () {
//     Route::post('/logout', [AuthController::class, 'logout']);
// });

//EMAILS SENDING FUNCTIONALITY
Route::post('/email/verification-notification', [UserController::class, 'resend']);
Route::post('/email/verify', [UserController::class, 'check']);
// Route::post('/email/verification-notification', [EmailController::class, 'resend'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
// Route::get('/email/verify/', [EmailController::class, 'check'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.verify');
