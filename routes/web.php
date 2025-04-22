<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

Route::get('change-language/{lang}', function ($lang) {
    if (in_array($lang, ['ar', 'en'])) {
        session(['locale' => $lang]);
        App::setLocale($lang);

        // Store in cookie for persistence
        cookie()->queue('locale', $lang, 60 * 24 * 365);
    }
    return redirect()->back();
})->name('change-language');