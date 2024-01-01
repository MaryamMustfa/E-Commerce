<!-- resources/views/user/details.blade.php -->

@extends('user.app')

@section('title', $product->name)

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif


<div style="text-align: center; margin-bottom: 20px;">
    <h1>{{ $product->name }}</h1>
    <img src="{{ $product->image }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 400px; object-fit: cover;">
    <p>{{ $product->description }}</p>
    <p>{{ $product->color }}</p>
    <p>{{ $product->size }}</p>
    <p>Price: {{ $product->price }}</p>
</div>

<div style="display: flex; justify-content: center; align-items: center; margin-bottom: 20px;">
    <a href="{{ route('invoice', ['id' => $product->id]) }}" class="btn btn-primary" role="button" style="margin-right: 10px; background-color: gray; border-color: gray;">Buy Now</a>

    <form action="{{ route('cart.add', ['id' => $product->id]) }}" method="post">
        @csrf
        <button type="submit" class="btn btn-success" style="background-color: gray; border-color: gray;">Add to Cart</button>
    </form>
</div>

@endsection
