<?php

use App\Http\Controllers\Auth\google;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\auth\auth;
Route::name("web.auth.")
    ->middleware(['web','api_without_auth'])
    ->group(function () {
    // instructor. routes
    Route::name("google.")
    ->controller(google::class)
    ->group(function () {
    Route::get('auth/google', 'redirectToGoogle')->name("redirectToGoogle");
    Route::get('auth/google/callback', 'handleGoogleCallBack')->name("handleGoogleCallBack");
    });
    });




