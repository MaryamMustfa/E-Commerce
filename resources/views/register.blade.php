<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <!-- Add the link to Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="col-md-6 offset-md-3">
        <h2 class="text-center mb-4">Register</h2>

        <form method="POST" action="{{ route('register.post') }}">
            @csrf

            <!-- Name Field -->
            <div class="form-group">
                <label for="name">Name</label>
                <input id="name" type="text" name="name" required autofocus class="form-control">
            </div>

            <!-- Email Field -->
            <div class="form-group">
                <label for="email">E-Mail</label>
                <input id="email" type="email" name="email" required class="form-control">
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required class="form-control">
            </div>

            <!-- Role Selection Field (Dynamically populated from the database, excluding 'admin') -->
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control">
                    @foreach ($roles as $id => $role)
                        @if ($role !== 'admin')
                            <option value="{{ $id }}">{{ $role }}</option>
                        @endif
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>

        <p class="mt-3 text-center">Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</div>

<!-- Add the link to Bootstrap JS and Popper.js -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
