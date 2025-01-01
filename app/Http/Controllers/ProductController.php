<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all(); // Fetch all products
        return view('admin.products', compact('products'));
    }

    public function create()
    {
        return view('admin.add-product');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'description' => 'required|string|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'quantity' => $validated['quantity'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
        ]);

        return redirect()->route('products.create')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.edit-product', compact('product'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);
    
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->description = $request->description;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }
    
        $product->save();
    
        return redirect()->route('admin.products')->with('success', 'Product updated successfully.');
    }
    
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully.');
    }
}
