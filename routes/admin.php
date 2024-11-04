<?php

use App\Http\Controllers\Admin\AppStringController;
use App\Http\Controllers\Admin\LanguageController;
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
Route::resource('relations', RelationController::class);

/* ----------------------------- Questions Route ----------------------------- */
Route::resource('questions', QuestionController::class);

/* ----------------------------- Plan Route ----------------------------- */
Route::resource('plans', PlanController::class);

/* ----------------------------- Language Route ----------------------------- */
Route::patch('language/change/{id}', 'LanguageController@change')->name('language.change');
Route::get('language/translate-strings/{id}', 'LanguageController@translateStrings')->name('language.translate-strings');
Route::post('language/update-translation', 'LanguageController@updateTranslation')->name('language.update-translation');
Route::resource('language', LanguageController::class)->except(['create']);

/* ----------------------------- App Strings Route ----------------------------- */
Route::resource('app-strings', AppStringController::class)->except(['show', 'create']);
