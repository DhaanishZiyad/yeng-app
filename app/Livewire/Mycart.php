<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class MyCart extends Component
{
    public $cartItems = [];
    public $total = 0;

    // Load cart items on mount
    public function mount()
    {
        $this->loadCartItems();
    }

    private function loadCartItems()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $this->cartItems = $cartItems->map(function ($item) {
            return [
                'id' => $item->id,
                'quantity' => $item->quantity,
                'price' => $item->price,
                'product' => [
                    'name' => $item->product->name,
                    'image_path' => $item->product->image_path,
                ],
            ];
        })->toArray();

        $this->calculateTotal();
    }

    // Increment quantity locally
    public function incrementQuantity($index)
    {
        $this->cartItems[$index]['quantity']++;
        $this->calculateTotal();
    }

    // Decrement quantity locally
    public function decrementQuantity($index)
    {
        if ($this->cartItems[$index]['quantity'] > 1) {
            $this->cartItems[$index]['quantity']--;
            $this->calculateTotal();
        }
    }

    // Calculate the total
    private function calculateTotal()
    {
        $this->total = array_sum(array_map(function ($item) {
            return $item['quantity'] * $item['price'];
        }, $this->cartItems));
    }

    // Sync changes to the database
    public function syncCartToDatabase()
    {
        foreach ($this->cartItems as $item) {
            $cartItem = Cart::find($item['id']);
            if ($cartItem) {
                $cartItem->quantity = $item['quantity'];
                $cartItem->save();
            }
        }
        session()->flash('message', 'Cart updated successfully.');
    }

    // Remove item from cart
    public function removeItem($cartItemId)
    {
        $cartItem = Cart::find($cartItemId);
        if ($cartItem) {
            $cartItem->delete();
            $this->loadCartItems();
        }
    }

    public function checkout()
    {
        return redirect()->route('session.checkout');
    }

    public function render()
    {
        return view('livewire.mycart');
    }
}
