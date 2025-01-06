    <div>
        <!-- Search Bar -->
        <input 
            type="text" 
            wire:model.live="search" 
            placeholder="Search..." 
            class="w-full p-2 pl-4 border-gray-400 border-2 focus:border-yeng-green-500 focus:ring-yeng-green-500 rounded-full mb-6"
        />

        <!-- Product Grid -->
        <div class="grid grid-cols-2 gap-4">
            @forelse ($products as $product)
                <a href="{{ url('/store/' . $product->id) }}" class="block">
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover">
                        <div class="px-4 py-2">
                            <h2 class="font-raleway font-bold mb-1">{{ $product->name }}</h2>
                            <p class="text-gray-900 font-semibold text-sm">LKR. {{ number_format($product->price, 2) }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p>No products found.</p>
            @endforelse
        </div>
    </div>