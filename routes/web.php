<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'verify.shopify']], function () {
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/dash', function () {
        return view('welcome', ['page' => 'dash']);
    })->name('dash');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});


