<!-- resources/views/admin/orders.blade.php -->

@extends('admin.dashboard')

@section('content')
    <h1>All Orders</h1>

    @if($orders->isEmpty())
        <p>No orders found.</p>
    @else
        <table id="ordersTable">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User Name</th>
                    <th>Total Cost</th>
                    <th>Product Name</th>
                    <th>Product image</th>


                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>${{ $order->total_cost }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td><img src="{{  $order->product->image }}" alt="Product Image" width="50"></td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

        <!-- Add DataTables JS (jQuery is required) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


       <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>


@endsection
