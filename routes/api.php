<?php

use App\Http\Controllers\Api\AuthController;
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

ROute::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('send-otp', 'sendOTP');
    Route::post('verify-otp', 'verifyOTP');
    Route::post('register', 'register');
    Route::post('login', 'login');
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
