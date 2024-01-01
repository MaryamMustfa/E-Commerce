<?php
// app/Http/Controllers/ShopController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;



class ShopController extends Controller
{
    public function create()
    {

        $user = Auth::user();

        if (!$user->hasCreatedShop()) {

            return view('shop.createshop');

        }

        return redirect()->route('products.index');
    }

    public function store(Request $request)
    {
        // Validation logic goes here
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'size' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
        
        ]);
            // Get the currently authenticated user
            $user = Auth::user();

            $shop = Shop::where('user_id',$user->id)->first();
            
            if (!is_null($shop)) {
                return redirect()->route('products.index')->with('error', 'You already have a shop.');

            }


        // Create a new shop

        $shop = Shop::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'size' => $request->input('size'),
            'location' => $request->input('location'),
            'user_id' => $user->id,
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(storage_path('app/public/shop_images'), $imageName);
            $shop->image = '/storage/shop_images/' . $imageName;
        }
        
        $shop->save();


        

        // Redirect to a success page or do something else
        return redirect()->route('products.index')->with('success', 'Shop created successfully!');
    }

    public function shoporder()
    {
        $user = Auth::user();

        // Retrieve orders with product and shop details for the shopkeeper's shop
        $orders = Order::with(['product.shops'])
            ->whereHas('product.shops', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->get();

        return view('shop.orders', compact('orders'));
    }


}
