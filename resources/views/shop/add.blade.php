@extends('shop.product')

@section('content')
    <div class="container">
        <h2>Add Product</h2>

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="4"></textarea>

            <label for="size">Size:</label>
            <input type="text" name="size">

            <label for="color">Color:</label>
            <input type="text" name="color">

            <div class="form-group">
             <label for="price">Price:</label>
             <input type="number" name="price" class="form-control">
         </div>


            <div class="form-group">
              <label for="image">Product Image:</label>
              <input type="file" name="image" accept="image/*">
           </div>

            <button type="submit">Submit</button>
        </form>
    </div>
@endsection
