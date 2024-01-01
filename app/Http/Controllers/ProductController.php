<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;
use App\Models\Shop;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        
        $user = auth()->user();
        $products = $user->shop->products;
        return view('shop.index', compact('products'));
    }

    public function create()
    {
        // Show the form for creating a new product
        $shops = Shop::all();
        return view('shop.add', compact('shops'));
    }

    public function store(Request $request)
{
    // Store a newly created product in storage
    $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'nullable|numeric|min:0',
    ]);

    // Assuming your Product model has a 'shop_id' field
    $user = auth()->user();
    $shop = $user->shop;

    $product = new Product([
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'size' => $request->input('size'),
        'color' => $request->input('color'),
        'price' => $request->input('price'),
    ]);

    $shop->products()->save($product);

    // Handle image upload
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(storage_path('app/public/product_images'), $imageName);
        $product->image = '/storage/product_images/' . $imageName;
        $product->save();
    }

    return redirect()->route('products.index')->with('success', 'Product created successfully!');
}


    public function edit(Product $product)
    {
        // Show the form for editing a specific product
        return view('shop.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        // Update the specified product in storage
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'nullable|string|max:255',
            'color' => 'nullable|string|max:255',
            'price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'size' => $request->input('size'),
            'color' => $request->input('color'),
            'price' => $request->input('price'),
        ]);
    
        // Handle image update
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/product_images'), $imageName);
            $product->image = '/storage/product_images/' . $imageName;
            $product->save();
        }

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        // Remove the specified product from storage
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
