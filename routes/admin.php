<?php

use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\RelationController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
*/


Route::get('/dashboard', function () {
    return view('pages.dashboard.index');
})->name('dashboard');

/* ----------------------------- Role Route ----------------------------- */
Route::resource('roles', RoleController::class);

/* ----------------------------- Relation Route ----------------------------- */
Route::resource('relations', RelationController::class)->except(['show']);

/* ----------------------------- Questions Route ----------------------------- */
Route::resource('questions', QuestionController::class)->except(['show']);

/* ----------------------------- Plan Route ----------------------------- */
Route::resource('plans', PlanController::class)->except(['show']);
