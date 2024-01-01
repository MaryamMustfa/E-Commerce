<!-- resources/views/user/home.blade.php -->

@extends('user.app')

@section('title', 'Home')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="container py-4 text-center"> <!-- Center-align the content -->
        <div class="mb-4 d-flex justify-content-end"> <!-- Move button to the right -->
            <a href="{{ route('seemore') }}" class="btn btn-primary" style="background-color: gray; border-color: gray;">
                See More Products
            </a>
        </div>
        <section id="section1">

        <h2 class="text-center mb-4">Featured Products</h2>
        <div class="d-flex flex-wrap justify-content-around"> <!-- Center-align and space between flex container -->
            @foreach ($products->take(9) as $product)
                <div style="width: 30%; margin-bottom: 20px;">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%; height: 200px; object-fit: cover;">
                    <h3 class="text-center">{{ $product->name }}</h3>
                    <p class="text-center">{{ $product->price }}</p>
                    <a href="{{ route('product.detail', $product) }}" class="btn btn-secondary btn-block">See Details</a>
                </div>
            @endforeach
        </div>
        </section>

        <section id="section2">
        <!-- Shop Carousel -->
        <div class="bg-light p-4 mt-4 mb-4"> <!-- Add a light background, padding, and margin -->
            @include('user.shop_carousel', ['shops' => $shops])
        </div>
    </div>
    </section>

@endsection
