<!-- resources/views/user/cart.blade.php -->

@extends('user.app')

@section('title', 'Shopping Cart')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div style="text-align: center;">
    <h1>Shopping Cart</h1>

    @if($cartItems->isEmpty())
        <p>Your cart is empty.</p>
    @else
        <div style="display: flex; flex-wrap: wrap; justify-content: center;">
            @foreach($cartItems as $cartItem)
                <div style="text-align: left; margin: 20px; padding: 20px; border: 1px solid #ddd; border-radius: 8px; width: 300px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                    <a href="{{ route('product.detail', ['id' => $cartItem->product_id]) }}" style="text-decoration: none; color: black;"> 
                        <p>{{ $cartItem->product->name }}</p>
                        <p>Quantity: {{ $cartItem->quantity }}</p>
                        <p>Price: {{ $cartItem->product->price }}</p>
                    </a>
                    <form action="{{ route('cart.remove', ['id' => $cartItem->product_id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background-color: gray; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer;">Remove from Cart</button>
                    </form>
                </div>
            @endforeach
        </div>

        <!-- Add the "Buy Now" button for all products -->
        <form action="{{ route('checkout-all') }}" method="post" style="text-align: center; margin-top: 20px;">
            @csrf
            <button type="submit" class="btn btn-primary" style="background-color: gray; border-color: gray; margin-bottom: 20px;">Buy Now for All</button>
        </form>
    @endif
</div>

@endsection
