@extends('layouts.main')

@section('content')
    <div class="text-center">
        <h1 class="text-4xl font-bold">Welcome to {{ ucfirst($page ?? 'laravel') }}</h1>
        <p class="mt-4">This is a Laravel application with Vite.js and Tailwind CSS.</p>
    </div>
@endsection
