@extends('layouts.store-app')

@section('content')

<!-- Title -->
<div class="mb-4 flex items-center">
    <a href="{{ url()->previous() }}">
        <img src="/images/left arrow.svg" alt="Back" class="h-8 w-8">
    </a>
    <h1 class="text-xl font-bold font-raleway ml-2">{{ $product->name }}</h1>
</div>

<!-- Product Image -->
<div class="flex justify-center">
    <div class="w-full max-w-screen-sm aspect-square bg-gray-200 rounded-lg overflow-hidden">
        @if($product->image_path)
            <img src="{{ asset('storage/' . $product->image_path) }}" 
                 alt="{{ $product->name }}" 
                 class="object-cover w-full h-full">
        @else
            <div class="flex items-center justify-center text-yeng-pink-500 font-bold uppercase text-6xl h-full w-full">
                {{ strtoupper(substr($product->name, 0, 1)) }}
            </div>
        @endif
    </div>
</div>

<!-- Product Information -->
<div class=" mt-6">
    <p class="font-bold text-2xl mt-2 text-gray-700">
        LKR. {{ number_format($product->price, 2) }}
    </p>
</div>

<!-- Quantity Dial and Add to Cart -->
<div class="mt-6">
    <form action="{{ route('store.add-to-cart', $product->id) }}" method="POST" class="flex items-center">
        @csrf
        <!-- Quantity Dial -->
        <div class="flex items-center rounded-full overflow-hidden border-2 border-yeng-green-500 mr-4 h-10">
            <button type="button" class="p-2 px-4 text-yeng-green-500 text-xl font-bold" onclick="decreaseQuantity()">-</button>
            <input type="number" name="quantity" id="quantity" 
                   value="1" min="1" max="{{ $product->quantity }}" 
                   class="w-12 text-center border-none focus:outline-none h-full">
            <button type="button" class="p-2 px-4 text-yeng-green-500 text-xl font-bold" onclick="increaseQuantity()">+</button>
        </div>
        <!-- Add to Cart Button -->
        <button type="submit" class="bg-yeng-green-500 text-white rounded-full px-6 font-raleway font-bold h-10">
            Add to Cart
        </button>
    </form>
</div>


<!-- Product Description -->
<div class="mt-6">
    <!-- Description Title -->
    <div class="flex font-raleway font-bold mt-4">
        <h1 class="text-gray-400">Description</h1>
    </div>

    <div>
        <p class="font-medium font-raleway">{{ $product->description }}</p>
    </div>
</div>

<script>
    function decreaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value--;
        }
    }

    function increaseQuantity() {
        let quantityInput = document.getElementById('quantity');
        if (quantityInput.value < {{ $product->quantity }}) {
            quantityInput.value++;
        }
    }
</script>

@endsection
