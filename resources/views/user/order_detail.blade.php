<!-- resources/views/user/order_details.blade.php -->

@extends('user.app')

@section('content')
    <h1>Order Details</h1>

    <strong>Order ID:</strong> {{ $order->id }}<br>
    <strong>Total Cost:</strong> ${{ $order->total_cost }}<br>

    <!-- Product Details -->
    <strong>Product Name:</strong> {{ $order->product->name }}<br>
    <strong>Product Image:</strong> <img src="{{ $order->product->image }}" alt="Product Image"><br>
    <strong>Product Price:</strong> ${{ $order->product->price }}<br>
    <strong>Product Description:</strong> {{ $order->product->description }}<br>

    <!-- Shop Details -->
    <strong>Shop Name:</strong> {{ $order->shop->name }}<br>

    <!-- Add more order details as needed -->

    <hr>
@endsection
