<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Courses\courses;
use App\Http\Controllers\Forms\ContactUS;
use App\Http\Controllers\Programs\Programs;
use App\Http\Controllers\Courses\courseRates;
use App\Http\Controllers\Categories\categories;
use App\Http\Controllers\Forms\InstructorsForm;
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
   // Courses routes
        Route::name("Courses.")
        ->prefix("Courses/")
        ->controller(courses::class)
        ->group(function () {
        Route::get('All', 'GetAll')->name("GetAll");
        Route::get('{code}', 'GetByCode')->name("GetByCode");
        Route::post('search','search')->name("search");
        });
// Programs routes
        Route::name("Programs.")
        ->prefix("Programs/")
        ->controller(Programs::class)
        ->group(function () {
        Route::get('All', 'GetAll')->name("GetAll");
        Route::get('{code}', 'GetByCode')->name("GetByCode");
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
        Route::controller(InstructorsForm::class)->group(function () {
            Route::post('Instructors', 'Instructors')->name("Instructors");
        });
    });

});

Route::name("api.app.")
    ->middleware(['api_with_auth'])
    ->group(function () {
    Route::name("Courses.")
        ->prefix("Courses/")
        ->controller(courseRates::class)
        ->group(function () {
        Route::post('Rate', 'CourseRates')->name("courseRates");
    });
});

