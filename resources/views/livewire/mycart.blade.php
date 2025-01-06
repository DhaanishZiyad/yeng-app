<div> 
    <div class="mt-6">
        @if(empty($cartItems))
            <p>Your cart is empty.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($cartItems as $index => $cartItem)
                    <div class="flex bg-white rounded-lg shadow-lg overflow-hidden" wire:key="cart-item-{{ $cartItem['id'] }}">
                        <!-- Product Image -->
                        <div class="w-1/3">
                            @if($cartItem['product']['image_path'])
                                <img src="{{ asset('storage/' . $cartItem['product']['image_path']) }}" 
                                     alt="{{ $cartItem['product']['name'] }}" 
                                     class="object-cover w-full h-full">
                            @else
                                <div class="flex items-center justify-center text-yeng-pink-500 font-bold uppercase text-6xl h-full w-full">
                                    {{ strtoupper(substr($cartItem['product']['name'], 0, 1)) }}
                                </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="flex flex-col justify-between px-4 py-2 w-2/3">
                            <div>
                                <h2 class="font-raleway text-lg font-bold text-gray-700">{{ $cartItem['product']['name'] }}</h2>
                                <p class="text-gray-500 font-medium">LKR. {{ number_format($cartItem['price'], 2) }}</p>
                            </div>

                            <!-- Quantity and Total Price -->
                            <div class="flex justify-between items-center">
                                <!-- Remove Item -->
                                <button wire:click="removeItem({{ $cartItem['id'] }})" 
                                        class="text-red-500 hover:text-red-700">
                                    Remove
                                </button>

                                <!-- Quantity Dial -->
                                <div class="flex items-center rounded-full overflow-hidden border-2 border-yeng-green-500 h-8">
                                    <button wire:click="decrementQuantity({{ $index }})" 
                                            class="p-1 px-3 text-yeng-green-500 text-lg font-bold">
                                        -
                                    </button>
                                    <span class="w-5 text-center border-none focus:outline-none h-full flex items-center justify-center text-sm">
                                        {{ $cartItem['quantity'] }}
                                    </span>
                                    <button wire:click="incrementQuantity({{ $index }})" 
                                            class="p-1 px-3 text-yeng-green-500 text-lg font-bold">
                                        +
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Cart Summary -->
            <div class="mt-6 text-right">
                <p class="font-bold text-lg">
                    Total: LKR. {{ number_format($total, 2) }}
                </p>

                <!-- Sync Changes Button -->
                <!-- <button wire:click="syncCartToDatabase" 
                        class="bg-yeng-pink-500 text-white px-6 py-2 rounded font-bold mt-4 inline-block">
                    Save Changes
                </button> -->

                <!-- Option 2: Direct Link -->
                <form action="{{ route('store.checkout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="bg-yeng-green-500 text-white rounded-full px-6 font-raleway font-bold h-10 mt-4 inline-block">
                        Proceed to Checkout
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
