@extends('layouts.main')

@section('content')
    <x-dashui-index-table :headings="[
        ['title' => 'ID', 'sortable' => true],
        ['title' => 'Name', 'sortable' => true],
        ['title' => 'Email', 'sortable' => true],
        ['title' => 'Date', 'sortable' => true],
    ]">
        @foreach($responses as $response)
            <x-dashui-table-row :id="$response->id">
                <x-dashui-table-cell>{{ $response->id }}</x-dashui-table-cell>
                <x-dashui-table-cell>{{ $response->name }}</x-dashui-table-cell>
                <x-dashui-table-cell>{{ $response->email }}</x-dashui-table-cell>
                <x-dashui-table-cell>{{ $response->created_at }}</x-dashui-table-cell>
            </x-dashui-table-row>
        @endforeach


    </x-dashui-index-table>

@endsection
