<!-- resources/views/admin/all_products.blade.php -->

@extends('admin.dashboard')

@section('title', 'All Products')

@section('content')
    <h2>All Products</h2>
    <!-- Your product table content goes here -->
    <table id="products-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <!-- Add more columns as needed -->
            </tr>
        </thead>
        <tbody>
            <!-- DataTables will handle rendering the table rows -->
        </tbody>
    </table>

    <!-- Include DataTables script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#products-table').DataTable({
                processing: true, // Enable server-side processing if needed
                serverSide: false, // Set to true if using server-side processing
                ajax: "{{ route('admin.getProducts') }}", // Adjust the route based on your setup
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    // Add more columns as needed
                ]
            });
        });
    </script>
@endsection
