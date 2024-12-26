@extends('layouts.main')

@section('content')

    <x-dashui-card>
        <x-slot:heading> Form Label Settings </x-slot:heading>
        <form action="{{ route('settings.form-labels') }}" method="post">
            <div class="mb-5">
                <label for="email" class="form-label">Name</label>
                <x-dashui-input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Name"
                />
            </div>

            <div class="mb-5">
                <label for="email" class="form-label">Email</label>
                <x-dashui-input
                    type="text"
                    name="email"
                    id="email"
                    placeholder="Email"
                />
            </div>
            <br>
            <x-dashui-button type="submit" variant="primary">Save</x-dashui-button>
        </form>
    </x-dashui-card>
@endsection
