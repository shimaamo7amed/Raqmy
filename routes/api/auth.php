<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\authintication;
use App\Http\Controllers\Countries\countries;
Route::name("api.auth.")
    ->middleware(['api_without_auth'])
    ->group(function () {
    Route::name("Authentication.")
    ->controller(authintication::class)
    ->group(function () {
    Route::post('register', 'Register')->name("Register");
    Route::post('verifyEmail', 'VerifyEmail')->name("VerifyEmail");
    Route::post('resendOtp', 'ResendOtp')->name("ResendOtp");
    Route::post('login', 'Login')->name("Login");
    Route::post('forgetPassword', 'ForgetPassword')->name("ForgetPassword");

    });
    Route::name("Countries.")
    ->controller(countries::class)
    ->group(function () {
    Route::get('getAllCountries', 'getAllCountries')->name("getAllCountries");
    Route::get('getGovernments/{country_id}', 'getGovernments')->name("getGovernments");
    });
});

Route::name("api.auth.")
    ->middleware(['api_with_auth'])
    ->group(function () {
    Route::name("Authentication.")
    ->controller(authintication::class)
    ->group(function () {
    Route::post('logout', 'Logout')->name("Logout");
    });
});