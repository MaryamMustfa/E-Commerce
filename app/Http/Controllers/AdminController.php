<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Product;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Order;


class AdminController extends Controller
{
    public function showDashboard()
    {
        return view('admin.dashboard');
    }

    public function showAllShops()
    {
        $shops = Shop::all();
    return view('admin.all_shops', compact('shops'));

    }

    public function showAllProducts()
    {
        $products = Product::all();
        return view('admin.all_products', compact('products'));
    
    }

    public function showShopProducts($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        return view('admin.shop_products', compact('shop'));
    }

    public function getShops()
    {
        return DataTables::of(Shop::query())->make(true);
    }

    public function getProducts()
    {
        return DataTables::of(Product::query())->make(true);
    }

    public function getShopProducts($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        $products = $shop->products;

                // Check if it's an AJAX request
                if(request()->ajax()) {
                    return DataTables::of($products)->make(true);
                }
        
        return view('admin.shop_products', compact('products', 'shop'));
       
    
    }

// for active or deactive 

public function activateShop($shopId)
{
    $shop = Shop::findOrFail($shopId);
    $shop->status = 1;
    $shop->save();

    return redirect()->route('admin.allShops')->with('success', 'Shop activated successfully');
}

public function deactivateShop($shopId)
{
    $shop = Shop::findOrFail($shopId);
    $shop->status = 0;
    $shop->save();

    return redirect()->route('admin.allShops')->with('success', 'Shop deactivated successfully');
}


//for displaying all orders  of users

public function order()
{
    // Retrieve all orders
    $orders = Order::with(['product', 'user'])->get();

    return view('admin.orders', compact('orders'));
}


}
