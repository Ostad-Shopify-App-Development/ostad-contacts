@extends('layouts.main')

@section('content')

    @include('settings.form-general', ['general' => $general])

    <br/>
    <br/>

    @include('settings.form-labels', ['labels' => $labels])

    <br/>
    <br/>

    @include('settings.form-customization', ['customization' => $customization])

@endsection
