<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\updateProfile;
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
    Route::post('refresh', 'refresh')->name("refresh");
    Route::post('forgetPassword', 'ForgetPassword')->name("ForgetPassword");
    Route::post('validateOtp', 'ValidateOtp')->name("ValidateOtp");
    Route::post('resetPassword', 'ResetPassword')->name("ResetPassword");

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
    Route::post('deleteMyAccount/{code}', 'DeleteMyAccount')->name("DeleteMyAccount");
    // updateProfile
    });
    Route::name("UpdateProfile.")
    ->controller(updateProfile::class)
    ->group(function () {
    Route::post('changePassword', 'ChangePassword')->name("ChangePassword");
    Route::post('updateProfile', 'UpdateProfile')->name("UpdateProfile");
    Route::post('verifyOtp', 'verifyOtp')->name("verifyOtp");
    // Route::post('changeUserName', 'ChangeUserName')->name("ChangeUserName");
    // Route::post('emailOTP', 'EmailOTP')->name("EmailOTP");
    // Route::post('changeEmail', 'ChangeEmail')->name("ChangeEmail");
    // Route::post('changePhone', 'ChangePhone')->name("ChangePhone");
    // Route::post('changeLocation', 'ChangeLocation')->name("ChangeLocation");
    });
});