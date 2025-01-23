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
        $customization = $user->config('customization');
        $general = $user->config('general');
        return view('settings.index', compact('labels', 'customization', 'general'));
    })->name('settings');

    Route::post('/settings/form-labels', function (\Illuminate\Http\Request $request, \App\Services\MetafieldService $metafieldService) {
        $user = auth()->user();
        $userSettings = $user->settings ?? [];
        $userSettings['form-labels'] = $request->only(['name', 'email', 'subject', 'message']);

        $user->settings = $userSettings;
        if (!$user->save()) {
            turbo_stream()->update('form-labels', view('settings.form-labels',['labels' => $request->only(['name', 'email', 'subject', 'message'])]));
            return turbo_stream()->flash("Failed to save!", 'error');
        }

        $metafield = [
            'key' => 'settings',
            'value' => json_encode($user->settings),
            'namespace' => 'ostad_contact',
            'ownerId' => $user->shopify_id,
            'type' => 'json',
        ];

        $metafieldService->updateMetafield($user, $metafield);

        return turbo_stream([
            turbo_stream()->update('form-labels', view('settings.form-labels', ['labels' => $request->only(['name', 'email', 'subject', 'message'])])),
            turbo_stream()->flash("Successfully saved!", 'success'),
        ]);

    })->name('settings.form-labels');

    Route::post('/settings/form-customization', function (\Illuminate\Http\Request $request, \App\Services\MetafieldService $metafieldService) {
        $user = auth()->user();
        $userSettings = $user->settings ?? [];
        $userSettings['customization'] = $request->only(['title', 'success_message']);

        $user->settings = $userSettings;
        if (!$user->save()) {
            turbo_stream()->update('form-customization', view('settings.form-customization',['customization' => $request->only(['title', 'success_message'])]));
            return turbo_stream()->flash("Failed to save!", 'error');
        }

        $metafield = [
            'key' => 'settings',
            'value' => json_encode($user->settings),
            'namespace' => 'ostad_contact',
            'ownerId' => $user->shopify_id,
            'type' => 'json',
        ];

        $metafieldService->updateMetafield($user, $metafield);

        return turbo_stream([
            turbo_stream()->update('form-customization', view('settings.form-customization', ['customization' => $request->only(['title', 'success_message'])])),
            turbo_stream()->flash("Successfully saved!", 'success'),
        ]);

    })->name('settings.form-customization');



    Route::post('/settings/form-general', function (\Illuminate\Http\Request $request, \App\Services\MetafieldService $metafieldService) {

        $user = auth()->user();
        $userSettings = $user->settings ?? [];
        $userSettings['general'] = $request->only(['send_confirmation_mail', 'save_as_customer', 'admin_notification']);

        $user->settings = $userSettings;
        if (!$user->save()) {
            turbo_stream()->update('form-general', view('settings.form-general',['general' => $user->config('general')]));
            return turbo_stream()->flash("Failed to save!", 'error');
        }

        $metafield = [
            'key' => 'settings',
            'value' => json_encode($user->settings),
            'namespace' => 'ostad_contact',
            'ownerId' => $user->shopify_id,
            'type' => 'json',
        ];

        $metafieldService->updateMetafield($user, $metafield);

        return turbo_stream([
            turbo_stream()->update('form-general', view('settings.form-general', ['general' => $user->config('general')])),
            turbo_stream()->flash("Successfully saved!", 'success'),
        ]);

    })->name('settings.form-general');


});

Route::get('/t', function () {
    /**
     * @var \Osiset\ShopifyApp\Contracts\ShopModel $shop
     */
   $shop = \App\Models\User::first();

   $resp = $shop->api()->graph(view('graphql.shop-info')->render());

   dd($resp['body']['data']['shop']['name']);
});


