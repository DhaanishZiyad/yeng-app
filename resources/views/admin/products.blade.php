@extends('layouts.admin-app')

@section('content')

    @if(session('success'))
        <div id="success-message" 
             class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Title Div -->
    <div class="flex justify-between font-raleway font-bold mb-4">
        <h1 class="text-xl">Products</h1>
        <a href="{{ route('products.create') }}" class="underline text-gray-500 font-semibold">
            Add Product
        </a>
    </div>

    <!-- Responsive Table for Products -->
    <div>
        <div class="overflow-x-auto">
            <table class="table-auto w-full border-collapse border border-gray-200">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Price</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Stock</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->price }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $product->quantity }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <!-- Center Align Buttons -->
                                <div class="flex justify-center items-center space-x-2">
                                    <a href="{{ route('products.edit', $product->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                                        Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this product?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded">
                                            Remove
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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