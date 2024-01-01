<?php
// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;


class PageController extends Controller
{
    public function home()
    {
        $products = Product::take(9)->get();
        $shops = Shop::all();
        return view('user.home', compact('products', 'shops'));
    }

    public function seeMore()
    {
        $products = Product::paginate(9);
        return view('user.seemore', compact('products'));
    }

    public function productDetail($id)
    {
        $product = Product::find($id);
        
        return view('user.details', compact('product'));
    }

    public function shopCarousel()
    {
        $shops = Shop::all();
        return view('user.shop_carousel', compact('shops'));
    }

    public function shopDetail(Shop $shop)
    {
        $products = $shop->products;
        return view('user.shopdetail', compact('shop', 'products'));
    }


}
