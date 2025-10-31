<?php

use Illuminate\Support\Facades\Route;

// All routes should return the Vue app (SPA catch-all)
Route::get('/{any}', function () {
    return view('app');
})->where('any', '.*');
