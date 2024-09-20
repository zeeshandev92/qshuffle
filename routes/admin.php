<?php

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


