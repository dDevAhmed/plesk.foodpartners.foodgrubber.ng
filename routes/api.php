<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\EmailController;

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
Route::group(['namespace' => 'App\Http\Controllers\Api'], function (){
    // Route::apiResource('customers', CustomerController::class);
    // Route::apiResource('invoices', InvoiceController::class);
    Route::post('/signup', [AuthController::class, 'signup']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot_password', [AuthController::class, 'forgot_password']);
});

//ROUTES THAT NEED AUTH AND VERIFIED EMAIL
// Route::group(['middleware' => ['auth:sanctum', verifiedUser::class]], function () {
Route::group(['namespace' => 'App\Http\Controllers\Api'], function () {
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile/avatar', [ProfileController::class, 'avatar'])->name('profile.avatar');
    Route::get('profile/avatar', [ProfileController::class, 'getavatar'])->name('profile.avatar');
})->middleware(['auth:sanctum', 'verified']);

//ROUTES THAT NEED ONLY AUTH
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

//EMAILS SENDING FUNCTIONALITY
Route::post('/email/verification-notification', [EmailController::class, 'resend'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.send');
Route::get('/email/verify/', [EmailController::class, 'check'])->middleware(['auth:sanctum', 'throttle:6,1'])->name('verification.verify');



