<!-- resources/views/user/seemore.blade.php -->

@extends('user.app')

@section('title', 'Products')

@section('content')

    <div class="container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-12">
                <h2 class="text-center mb-4">Products</h2>
            </div>
        </div>

        <div id="productsContainer" class="row">
            @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="card-img-top" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h3 class="card-title">{{ $product->name }}</h3>
                            <p class="card-text">{{ $product->price }}</p>
                            <a href="{{ route('product.detail', $product) }}" class="btn btn-primary">See Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="pagination" class="text-center mt-4" st>
            <div style="clear: both; background-color:#fff;">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>
        </div>
    </div>

    <style>
        .pagination {
            justify-content: center;
            margin-top: 20px;
            margin-left:40%;
        }

        .pagination .page-item .page-link {
            background-color: #ccc;
            color: #333;
        }

        .pagination .page-item.active .page-link {
            background-color: #555;
            color: #fff;
            border-color:#fff;
        }

        .btn-primary {
            background-color: gray; /* Change this to your desired button color */
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: darkgray; /* Change this to your desired button hover color */
            color: #fff;
        }
    </style>

@endsection
