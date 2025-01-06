@extends('layouts.store-app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mb-4">
        <h1 class="text-xl">Home Page</h1>
    </div>

    <!-- Livewire Component -->
    @livewire('product-search')

@endsection