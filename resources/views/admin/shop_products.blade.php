@extends('admin.dashboard')

@section('content')
    <h2>{{ $shop->name }} Products</h2>
    <!-- Your shop products content goes here -->
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
    <script>
        $(document).ready(function () {
            $('#products-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getShopProducts', $shop->id) }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                ]
            });
        });
    </script>
@endsection
