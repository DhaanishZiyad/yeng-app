@extends('layouts.store-app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold">
        <h1 class="text-xl">Cart</h1>
    </div>

    @if(session('success'))
        <div id="success-message" 
             class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @livewire('my-cart')

    <script>
        // Automatically hide the success message after 5 seconds
        document.addEventListener('DOMContentLoaded', () => {
            const successMessage = document.getElementById('success-message');
            if (successMessage) {
                setTimeout(() => {
                    successMessage.style.transition = "opacity 0.5s ease-in-out";
                    successMessage.style.opacity = "0";
                    setTimeout(() => successMessage.remove(), 500); // Remove element after fade-out
                }, 3000); // 5 seconds
            }
        });
    </script>

@endsection