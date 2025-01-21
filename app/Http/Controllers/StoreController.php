<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Livewire\Livewire;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.homepage');
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id);
        return view('store.product-detail', compact('product'));
    }

    public function wishlist()
    {
        return view('store.wishlist');
    }

    public function cart()
    {
        // Fetch cart items for the currently authenticated user
        $cartItems = Cart::where('user_id', auth()->id())->get();
        return view('store.cart', compact('cartItems'));
    }

    public function orders()
    {
        // Fetch all orders for the authenticated user
        $orders = Order::where('user_id', auth()->id())->with('items.product')->get();

        return view('store.orders', compact('orders'));
    }

    public function orderDetail($id)
    {
        // Fetch the order and its items
        $order = Order::with('items.product')
            ->where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('store.order-detail', compact('order'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Check if the quantity is valid
        $quantity = $request->input('quantity');
        if ($quantity <= 0 || $quantity > $product->quantity) {
            return back()->with('error', 'Invalid quantity');
        }

        // Create or update the cart entry
        $cartItem = Cart::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $id,
            ],
            [
                'quantity' => $quantity,
                'price' => $product->price,
            ]
        );

        return redirect()->route('store.cart')->with('success', 'Product added to cart');
    }

    public function checkout(Request $request)
    {
        $userId = auth()->id();

        // Fetch cart items for the authenticated user
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('store.cart')->with('error', 'Your cart is empty!');
        }

        DB::beginTransaction();

        try {
            // Calculate the total price
            $total = $cartItems->sum(function ($item) {
                return $item->quantity * $item->price;
            });

            // Create the order
            $order = Order::create([
                'user_id' => $userId,
                'total' => $total,
                'status' => 'pending',
            ]);

            // Add items to the order
            foreach ($cartItems as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price,
                ]);
            }

            // Clear the user's cart
            Cart::where('user_id', $userId)->delete();

            DB::commit();

            return redirect()->route('store.orders')->with('success', 'Order placed successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('store.cart')->with('error', 'Failed to process your order. Please try again.');
        }
    }

    public function stripePayment()
    {
        $userId = auth()->id();

        // Fetch cart items for the user
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('store.cart')->with('error', 'Your cart is empty!');
        }

        // Prepare Stripe line items
        $lineItems = $cartItems->map(function ($item) {
            return [
                'price_data' => [
                    'currency' => 'lkr', // Adjust the currency as needed
                    'product_data' => [
                        'name' => $item->product->name,
                    ],
                    'unit_amount' => $item->price * 100, // Stripe requires amounts in cents
                ],
                'quantity' => $item->quantity,
            ];
        })->toArray();

        // Initialize Stripe
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create a Stripe Checkout session
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('store.stripe-success'),
            'cancel_url' => route('store.cart'),
        ]);

        // Redirect to Stripe-hosted checkout page
        return redirect($checkoutSession->url);
    }

    public function stripeSuccess()
    {
        $userId = auth()->id();

        DB::beginTransaction();

        try {
            // Call the placeOrder method to create the order
            $this->placeOrder($userId);

            DB::commit();

            return redirect()->route('store.orders')->with('success', 'Payment successful and order placed!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('store.cart')->with('error', 'Failed to process your payment. Please try again.');
        }
    }


    private function placeOrder($userId)
    {
        $cartItems = Cart::with('product')->where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            throw new \Exception('Cart is empty');
        }

        // Calculate total price
        $total = $cartItems->sum(fn($item) => $item->quantity * $item->price);

        // Create the order
        $order = Order::create([
            'user_id' => $userId,
            'total' => $total,
            'status' => 'completed',
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

        // Clear the user's cart
        Cart::where('user_id', $userId)->delete();
    }
}
