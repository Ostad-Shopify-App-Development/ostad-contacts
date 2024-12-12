<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite(['resources/css/tailwind.css'])
    @stack('styles')
</head>
<body class="antialiased">


<div class="mx-auto mt-14 max-w-7xl p-4 lg:p-6 m-auto">
    @include('partials.navigation')

    <main>
        <x-turbo::frame id="content-frame">
            @yield('content')
        </x-turbo::frame>
    </main>
</div>

<div class="no"></div>
@include('partials.appbridge-data')


<script src="https://unpkg.com/codyhouse-framework/main/assets/js/util.js"></script>
<script src="{{config('shopify-app.appbridge_cdn_url') ?? 'https://unpkg.com'}}/@shopify/app-bridge{{ \Osiset\ShopifyApp\Util::getShopifyConfig('appbridge_version') ? '@'.config('shopify-app.appbridge_version') : '' }}"></script>

{{--<script
    @if(\Osiset\ShopifyApp\Util::getShopifyConfig('turbo_enabled'))
        data-turbolinks-eval="false"
    @endif
>
    var AppBridge = window['app-bridge'];
    var actions = AppBridge.actions;
    var utils = AppBridge.utilities;
    var createApp = AppBridge.default;
    var app = createApp({
        apiKey: "{{ \Osiset\ShopifyApp\Util::getShopifyConfig('api_key', $shopDomain ?? Auth::user()->name ) }}",
        host: "{{ \Request::get('host') }}",
        forceRedirect: true,
    });
</script>--}}
@vite(['resources/js/app.js'])
@stack('scripts')
</body>
</html>
