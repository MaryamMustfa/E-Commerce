<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;



class CartController extends Controller
{
    public function showCart()
    {
        $cartItems = CartItem::where('user_id', auth()->id())->with('product')->get();

        return view('user.cart', compact('cartItems'));
    }

    public function addToCart(Request $request, $productId)
    {
        // Get the product details
        $shopId = Product::find($productId)->shops()->value('shop_id');

        // Find the cart item for the user and product
        $cartItem = CartItem::where('user_id', auth()->id())
                            ->where('product_id', $productId)
                            ->first();

        if ($cartItem) {
            // If exists, increment quantity
            return redirect()->back()->with('info', 'Item already exists in the cart');
        } else {
            // If not, create a new cart item
            CartItem::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'shop_id' => $shopId,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart successfully');
    }

    public function removeFromCart(Request $request, $productId)
    {
        // Find and delete the cart item
        CartItem::where('user_id', auth()->id())
                ->where('product_id', $productId)
                ->delete();

        return redirect()->back()->with('success', 'Item removed from cart successfully');
    }

    public function checkoutAll(Request $request)
{
    $user = auth()->user();

    // Get all products in the user's cart
    $cartItems = CartItem::where('user_id', $user->id)->get();

    // Check if the cart is not empty
    if ($cartItems->isEmpty()) {
        return redirect()->route('cart')->with('error', 'Your cart is empty.');
    }

    // Initialize total cost
    $totalCost = 0;

    foreach ($cartItems as $cartItem) {
        // Calculate the total cost for each product
        $totalCost += $cartItem->product->price * $cartItem->quantity;

        // Create a new order for each cart item
        $order = new Order([
            'user_id' => $user->id,
            'product_id' => $cartItem->product->id,
            'shop_id' => $cartItem->product->shops->first()->id,
            'total_cost' => $totalCost,
        ]);

        $order->save();
    }

    // Remove all items from the cart
    CartItem::where('user_id', $user->id)->delete();

    // Save the order details in the session
    session(['order' => $order]);

    // Flash success message
    session()->flash('success', 'Your order has been successfully placed!');

    // Redirect to the home page or wherever you want
    return redirect()->route('home');
}

}
