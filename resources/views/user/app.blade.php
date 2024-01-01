<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Your E-Commerce Website')</title>
     <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Include Font Awesome stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Include Slick CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css">
     <!-- Include Bootstrap and jQuery scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include Slick JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        nav {
            background-color: #333;
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav .logo img {
            max-height: 40px;
        }

        nav .search-bar {
            display: flex;
            align-items: center;
        }

        nav input[type="text"] {
            padding: 5px;
            margin-right: 5px;
        }

        nav button {
            background-color: #fff;
            color: #333;
            border: none;
            padding: 5px;
            cursor: pointer;
        }

        ul.menu {
            list-style-type: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        ul.menu li {
            margin-right: 20px;
        }


        ul.menu li {
        margin-right: 20px;
    }

    ul.menu li a {
        text-decoration: none; /* Remove underline from links */
        color: #fff;
    }

    nav .logo a {
        text-decoration: none; /* Remove underline from the logo link */
        color: #fff;
    }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
            position: relative;
            bottom: 0;
            width: 100%;
        }

 
    </style>


</head>
<body>

<!-- Navigation Bar -->
<nav>
    <div class="logo">
        <a href="{{ route('home') }}"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search...">
        <button><i class="fas fa-search"></i></button>
    </div>
    <ul class="menu">
        <li><a href="{{ route('home') }}#section1">Products</a></li>
        <li><a href="{{ route('home') }}#section2">Shops</a></li>
        <li><a href="{{ route('orders.index') }}">Your Orders</a></li>
        <li><a href="{{ route('cart') }}"><i class="fas fa-shopping-cart"></i></a></li>
        <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i></a></li>

    </ul>
</nav>

<!-- Page Content -->
<div class="content">
    @yield('content')
</div>

<!-- Footer -->
<footer>
    <p>&copy; {{ date('Y') }} Your E-Commerce Website. All rights reserved.</p>
</footer>

<!-- Add your scripts here -->
@stack('scripts')

</body>
</html>
