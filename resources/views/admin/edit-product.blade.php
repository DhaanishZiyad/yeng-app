@extends('layouts.admin-app')

@section('content')

    @if(session('success'))
        <div id="success-message" 
             class="bg-green-100 text-green-800 font-bold px-4 py-3 rounded-lg shadow-lg mb-4">
            {{ session('success') }}
        </div>
    @endif

    <!-- Title Div -->
    <div class="mb-8 flex items-center">
        <a href="{{ route('admin.products') }}">
            <img src="/images/left arrow.svg" alt="Back" class="h-8 w-8">
        </a>
        <h1 class="text-xl font-bold font-raleway ml-2">Edit Product</h1>
    </div>

    <!-- Edit Product Form -->
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Product Name -->
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-semibold">Product Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm" required>
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Price -->
        <div class="mb-4">
            <label for="price" class="block text-gray-700 font-semibold">Price</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm" step="0.01" required>
            @error('price')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Quantity -->
        <div class="mb-4">
            <label for="quantity" class="block text-gray-700 font-semibold">Quantity</label>
            <input type="number" name="quantity" id="quantity" value="{{ $product->quantity }}" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm" required>
            @error('quantity')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Description -->
        <div class="mb-4">
            <label for="description" class="block text-gray-700 font-semibold">Description</label>
            <textarea name="description" id="description" class="mt-2 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-400 focus:border-blue-400 text-sm" rows="4" required>{{ $product->description }}</textarea>
            @error('description')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Product Image -->
        <div class="mb-4">
            <label for="image" class="block text-gray-700 font-semibold">Product Image</label>
            <input type="file" name="image" id="image" class="mt-2 block w-full text-sm" accept="image/*">
            <small class="text-gray-500">Leave empty to keep the current image.</small>
            @error('image')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" class="bg-gray-500 w-full text-white font-raleway font-bold px-8 py-2 rounded-md">
                Update Product
            </button>
        </div>
    </form>

@endsection
