<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">

    @vite(['resources/css/tailwind.css'])
    @stack('styles')
</head>
<body class="antialiased">


<div class="mx-auto mt-14 max-w-52 p-4 lg:p-6 m-auto" style="max-width: 760px;">
    {{--@include('partials.navigation')--}}

    <main>
        <x-turbo::frame id="content-frame">
            @yield('content')
        </x-turbo::frame>
    </main>
</div>

<div class="no"></div>

<div id="flash">

</div>

@include('partials.appbridge-data')


<script src="https://unpkg.com/codyhouse-framework/main/assets/js/util.js"></script>
<script>
    let appEnv = "{{ env('APP_ENV', 'testing') }}";
</script>
@vite(['resources/js/app.js'])
@stack('scripts')
</body>
</html>
