<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Categories\categories;
use App\Http\Controllers\Instructors\instructors;

// all routes without auth
Route::name("api.app.")
    ->middleware(['api_without_auth'])
    ->group(function () {
        // instructor. routes
        Route::name("instructor.")
        ->prefix("Instructors/")
        ->controller(instructors::class)
        ->group(function () {
        Route::get('All', 'GetAll')->name("GetAll");
        Route::get('{code}', 'GetByCode')->name("Details");
        });
        // Categories routes
        Route::name("Categories.")
        ->prefix("Categories/")
        ->controller(categories::class)
        ->group(function () {
        Route::get('All', 'GetAll')->name("GetAll");
        });
    });

