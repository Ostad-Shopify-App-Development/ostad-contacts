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
        $user = auth()->user();
        $labels = $user->config('form-labels');
        return view('settings.index', compact('labels'));
    })->name('settings');

    Route::post('/settings/form-labels', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        $userSettings = $user->settings ?? [];
        $userSettings['form-labels'] = $request->only(['name', 'email', 'subject', 'message']);

        $user->settings = $userSettings;
        if (!$user->save()) {
            turbo_stream()->update('form-labels', view('settings.form-labels',['labels' => $request->only(['name', 'email', 'subject', 'message'])]));
            return turbo_stream()->flash("Failed to save!", 'error');
        }

        return turbo_stream([
            turbo_stream()->update('form-labels', view('settings.form-labels', ['labels' => $request->only(['name', 'email', 'subject', 'message'])])),
            turbo_stream()->flash("Successfully saved!", 'success'),
        ]);

    })->name('settings.form-labels');


});


