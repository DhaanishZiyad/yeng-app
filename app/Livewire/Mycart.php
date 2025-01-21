<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class MyCart extends Component
{
    public $cartItems = [];
    public $total = 0;
    public $paymentMethod; // New property for payment method

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

    public function proceedToCheckout()
    {
        if ($this->paymentMethod === 'cod') {
            // Handle Cash on Delivery
            $this->checkoutCod();
        } elseif ($this->paymentMethod === 'card') {
            // Emit an event to trigger a redirect in the frontend
            $this->callStripePaymentController();
        } else {
            session()->flash('error', 'Please select a payment method.');
        }
    }

    public function callStripePaymentController()
    {
        // Trigger the controller method from here
        $controller = new \App\Http\Controllers\StoreController();
        return $controller->stripePayment();
    }

    private function checkoutCod()
    {
        DB::beginTransaction();
    
        try {
            $userId = auth()->id();
            $cartItems = Cart::with('product')->where('user_id', $userId)->get();
        
            if ($cartItems->isEmpty()) {
                session()->flash('error', 'Your cart is empty.');
                return;
            }
        
            // Calculate total price
            $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);
        
            // Create order
            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => 'cod',
            ]);
        
            // Create order items
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);
            }
        
            // Clear cart
            Cart::where('user_id', $userId)->delete();
        
            DB::commit();
        
            // Redirect to orders page with success message
            return redirect()->route('store.orders')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to place the order. Please try again.');
        }
    }

    public function redirectToStripe()
    {
        $stripeUrl = URL::route('store.stripe-payment'); // Dynamically generate Stripe payment URL
        $this->dispatchBrowserEvent('redirectTo', ['url' => $stripeUrl]);
    }

    public function redirectToOrders($message)
    {
        $ordersUrl = URL::route('store.orders'); // Dynamically generate Orders page URL
        $this->dispatchBrowserEvent('redirectTo', ['url' => $ordersUrl, 'message' => $message]);
    }

    public function redirectToCart($message)
    {
        $cartUrl = URL::route('store.cart'); // Dynamically generate Cart page URL
        $this->dispatchBrowserEvent('redirectTo', ['url' => $cartUrl, 'message' => $message]);
    }


}
