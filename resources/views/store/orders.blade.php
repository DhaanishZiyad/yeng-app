@extends('layouts.store-app')

@section('content')

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mb-4">
        <h1 class="text-xl">Orders</h1>
    </div>

    @if(session('success'))
        <div id="success-message" 
             class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if ($orders->isEmpty())
        <p class="text-gray-500 text-center mt-6">You have no orders yet.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($orders as $order)
                <!-- Order Card -->
                <a href="#" 
                   class="block bg-white p-6 py-4 rounded-lg shadow-lg border-yeng-green-500 border-2 hover:shadow-md transition-shadow duration-200">
                    <!-- Order Number and Total -->
                    <div class="flex justify-between text-lg font-bold">
                        <p>Order #{{ $order->id }}</p>
                        <p>LKR. {{ number_format($order->total, 2) }}</p>
                    </div>

                    <!-- Date and Status -->
                    <div class="flex justify-between items-center text-sm font-bold mt-2">
                        <p class="text-gray-400">
                            {{ \Carbon\Carbon::parse($order->created_at)->format('l, jS F') }}
                        </p>
                        <span class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-4 py-1 rounded-full">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

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