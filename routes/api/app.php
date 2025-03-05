<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Forms\ContactUS;
use App\Http\Controllers\Forms\Instructors;
use App\Http\Controllers\Categories\categories;

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

          //Forms routes
    Route::name("Forms.")
    ->prefix("form/")
    ->group(function () {
        Route::controller(ContactUS::class)->group(function () {
            Route::post('contactUs', 'ContactUS')->name("ContactUS");
        });
        Route::controller(Instructors::class)->group(function () {
            Route::post('Instructors', 'Instructors')->name("Instructors");
        });
    });

    });

