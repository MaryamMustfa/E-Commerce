<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Shop;
use App\Models\Product;



class OrderListController extends Controller
{
    public function index()
    {
        
        $user = auth()->user();

        // Retrieve the user's orders with product details
        $orders = Order::with(['product.shops'])->where('user_id', $user->id)->get();

    
        // dd($orders->toArray());

        return view('user.order_list', compact('orders'));
    }

    public function show($orderId)
    {
        $order = Order::with(['product.shops'])->findOrFail($orderId);

        return view('user.order_detail', compact('order'));
    }


}
