<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\ProductCntroller;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\PasswordResetController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class,'register']);
Route::post('/login', [AuthController::class,'login']);
Route::post('verifiy', [UserController::class,'verifiy'])->middleware('auth:sanctum');
Route::post('reset_password', [PasswordResetController::class, 'send_reset']);
Route::post('reset_password/check', [PasswordResetController::class, 'check']);
Route::post('reset_password/reset', [PasswordResetController::class, 'reset']);

Route::middleware(['auth:sanctum','VerifiedUsers'])->group(function () {
    Route::get('/logout', [AuthController::class,'logout']);
    Route::get('/profile', [UserController::class,'profile']);
    Route::get('resend_verification_code',[UserController::class,'resend_verification_code']);
    Route::get('my_Product',[UserController::class,'my_Product']);
    Route::post('product/{id}', [ProductCntroller::class, 'update']);
    Route::apiResource('product',ProductCntroller::class);

});
