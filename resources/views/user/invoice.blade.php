<!-- resources/views/user/invoice.blade.php -->

@extends('user.app')

@section('title', 'Order Invoice')

@section('content')
    <h1>Order Invoice</h1>
    <p>Product: {{ $product->name }}</p>
    <p>Price: {{ $product->price }}</p>

    <!-- Additional details -->
    <p>Platform Fee: $10</p>
    <p>Delivery Fee: $100</p>

    <!-- Calculate total cost -->
    @php
        $platformFee = 10;
        $deliveryFee = 100;
        $totalCost = $product->price + $platformFee + $deliveryFee;
    @endphp

    <p>Total Cost: ${{ $totalCost }}</p>

    <form action="{{ route('checkout', ['productId' => $product->id]) }}" method="post">
        @csrf
        <button type="submit">Checkout</button>
    </form>
@endsection

