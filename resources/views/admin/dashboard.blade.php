<!-- resources/views/admin/dashboard.blade.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5; /* Set a light background color */
            display: flex;
            flex-direction: column; /* Set the direction to column */
            height: 100vh;
        }

        .top-bar {
            background-color: #3498db; /* Blue color for the top bar */
            color: #fff;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 2; /* Ensure the top bar is above other elements */
        }

        .logo img {
            max-height: 40px; /* Adjust the logo height as needed */
        }

        .admin-container {
            display: flex;
            flex: 1;
            overflow: hidden;
        }

        .side-bar {
            background-color: #2980b9; /* Blueish color for the side bar */
            padding: 20px 0;
            display: flex;
            flex-direction: column; /* Set the direction to column */
            align-items: center;
            width: 200px; /* Set a fixed width for the side bar */
            z-index: 1; /* Ensure the side bar is behind the top bar */
        }

        .side-bar ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column; /* Set the direction to column */
            align-items: center;
        }

        .side-bar li {
            margin-bottom: 10px;
        }

        .side-bar a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            padding: 10px;
        }

        .side-bar a:hover {
            background-color: #1a5276; /* Darker blue on hover */
        }

        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto; /* Enable scrolling if content overflows */
        }

    </style>

</head>

<body>
    <!-- Top Bar -->
    <div class="top-bar">
        <!-- Admin Profile -->

        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('path/to/your/logo.png') }}" alt="Logo">
        </div>
       <div>
        <a href="{{ route('logout') }}">Logout</a>
    </div>
    </div>

    <div class="admin-container">
        <!-- Side Bar -->
        <div class="side-bar">
            <ul>
                <li><a href="{{ route('admin.allShops') }}">All Shops</a></li>
                <li><a href="{{ route('admin.allProducts') }}">All Products</a></li>
                <li><a href="{{ route('admin.orders') }}">All orders</a></li>

            </ul>
        </div>

        <!-- Main Content Area -->
        <div class="main-content">
            @yield('content')
        </div>
    </div>

    <!-- Include jQuery and DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>


    @yield('scripts') 
</body>

</html>
