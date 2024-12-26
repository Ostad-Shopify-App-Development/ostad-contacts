<?php

use Illuminate\Support\Facades\Route;

$middleware = ['web'];

if (!app()->environment('testing')) {
    $middleware[] = 'verify.shopify';
}

Route::group(['middleware' => $middleware], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/dash', function () {
        return view('welcome', ['page' => 'dash']);
    })->name('dash');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');

    Route::post('/settings/form-labels', function () {
        return view('settings');
    })->name('settings.form-labels');


});


