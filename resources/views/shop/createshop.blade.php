<!-- resources/views/shop/create.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Shop</title>
</head>
<body>
    <div class="container">
        <h2>Create Shop</h2>

        <form action="{{ route('shop.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <label for="name">Name:</label>
            <input type="text" name="name" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="4"></textarea>

            <label for="size">Size:</label>
            <input type="text" name="size">

            <label for="location">Location:</label>
            <input type="text" name="location">

            <div class="form-group">
              <label for="image">Shop Image:</label>
              <input type="file" name="image" accept="image/*">
          </div>


            <button type="submit">Create Shop</button>
        </form>
    </div>
</body>
</html>
