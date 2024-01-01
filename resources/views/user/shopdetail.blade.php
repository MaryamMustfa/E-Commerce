<!-- resources/views/shops/show.blade.php -->

@extends('user.app')

@section('title', $shop->name)

@section('content')
    <h1>{{ $shop->name }}</h1>
    <p>{{ $shop->description }}</p>
    <p>{{ $shop->description }}</p>
    <p>{{ $shop->size }}</p>
    <p>{{ $shop->location }}</p>


    
    <!-- Display shop details as needed -->

    <h2>Products</h2>
    <div id="productsContainer" style="display: flex; flex-wrap: wrap; justify-content: space-between;">
        @foreach ($products as $product)
            <div style="width: 30%; margin-bottom: 20px;">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                <h3>{{ $product->name }}</h3>
                <p>{{ $product->price }}</p>
                <!-- Add more details as needed -->
                <a href="{{ route('product.detail', $product) }}" class="see-details-button">See Details</a>
            </div>
        @endforeach
    </div>
@endsection
