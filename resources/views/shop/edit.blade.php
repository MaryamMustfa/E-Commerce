@extends('shop.product')

@section('content')
    <div class="container">
        <h2>Edit Product</h2>

        <form action="{{ route('products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT') <!-- Use PUT method for update -->

            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ $product->name }}" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="4">{{ $product->description }}</textarea>

            <label for="size">Size:</label>
            <input type="text" name="size" value="{{ $product->size }}">

            <label for="color">Color:</label>
            <input type="text" name="color" value="{{ $product->color }}">

            <div class="form-group">
              <label for="price">Price:</label>
              <input type="number" name="price" class="form-control" value="{{ $product->price }}">
          </div>


            <div class="form-group">
              <label for="image">Product Image:</label>
              <input type="file" name="image" accept="image/*" value="{{ $product->image }}">
           </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
