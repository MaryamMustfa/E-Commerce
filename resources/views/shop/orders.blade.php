<!-- resources/views/shop/orders.blade.php -->

@extends('shop.product')

@section('content')
    <h1>Your Shop's Order History</h1>

    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
        <table id="ordersTable" class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Total Cost</th>
                    <th>Product Name</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Product Description</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ $order->total_cost }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td><img src="{{ $order->product->image }}" alt="Product Image" width="50"></td>
                        <td>${{ $order->product->price }}</td>
                        <td>{{ $order->product->description }}</td>
                
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- Include DataTables scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>
@endsection
