<?php
// app/Http/Controllers/CheckoutController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;



class CheckoutController extends Controller
{
    public function invoice($id)
    {
        $product = Product::findOrFail($id);

        return view('user.invoice', compact('product'));
    
    }

    public function checkout(Request $request, $productId)
    {
        // Retrieve product information based on the provided product ID
        $product = Product::findOrFail($productId);
    
        // Calculate total cost
        $platformFee = 10;
        $deliveryFee = 100;
        $totalCost = $product->price + $platformFee + $deliveryFee;
    
        // Assuming a logged-in user; customize this based on your authentication logic
        $user = auth()->user();


       // Get the shop ID directly from the product
       $shopId = $product->shops->first()->id;

    
    
        // Create a new order and associate it with the user and product
        $order = new Order([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'shop_id' => $shopId,
            'total_cost' => $totalCost,
        ]);
    
        $order->save();
    
        // Save the order details in the session
        session(['order' => $order]);
    
        // Flash success message
        session()->flash('success', 'Your order has been successfully placed!');
    
        // Redirect to the home page
        return redirect()->route('home');
    }
        


}


