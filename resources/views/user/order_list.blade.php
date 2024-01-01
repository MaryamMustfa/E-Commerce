<!-- resources/views/user/order_list.blade.php -->

@extends('user.app')

@section('content')
    <h1>Your Order History</h1>

    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
        <ul>
            @foreach($orders as $order)
                <li>
                    <strong>Order ID:</strong> {{ $order->id }}<br>
                    <strong>Total Cost:</strong> ${{ $order->total_cost }}<br>

                    <!-- Link to Order Details -->
                    <a href="{{ route('orders.show', ['orderId' => $order->id]) }}">View Details</a>

                    <hr>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
