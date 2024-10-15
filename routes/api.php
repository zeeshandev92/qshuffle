<?php

use App\Http\Controllers\Admin\RelationController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InviteeController;
use App\Http\Controllers\Api\UserController;
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

Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('send-otp', 'sendOTP');
    Route::post('verify-otp', 'verifyOTP');
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('forgot-password', 'forgotPassword');
    Route::post('reset-password', 'resetPassword');
});

Route::controller(RelationController::class)->group(function () {
    Route::get('relations/{language}', 'relationsList');
});


Route::get('invitee',  [InviteeController::class, 'index']);
Route::put('invitee/{code}',  [InviteeController::class, 'update']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('invitee',  [InviteeController::class, 'store']);

    Route::apiResource('user', UserController::class)->only(['index', 'update']);
});
