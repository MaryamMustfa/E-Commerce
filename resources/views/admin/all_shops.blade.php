@extends('admin.dashboard')

@section('content')
    <h2>All Shops</h2>
    <!-- Your all shops content goes here -->
    <table id="shops-table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Size</th>
                <th>Location</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- DataTables will handle rendering the table rows -->
        </tbody>
    </table>

    <!-- Container for displaying shop products -->
    <div id="products-container" style="display: none;">
        <!-- Placeholder for shop name -->
        <h2 id="shop-name-placeholder"></h2>

        <!-- Close button to hide the products table -->
        <button id="close-products-btn" class="btn btn-danger">Close</button>

        <!-- DataTable for shop products -->
        <table id="products-table" class="display"></table>
    </div>

    <!-- Include DataTables script -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <!-- Include DataTables script -->
    <script>
        $(document).ready(function () {
            var shopsDataTable = $('#shops-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getShops') }}",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'size', name: 'size' },
                    { data: 'location', name: 'location' },
                    { data: 'status', name: 'status' },
                    { data: null, render: renderActions }
                ]
            });

            $('#shops-table tbody').on('click', 'tr', function () {
                var data = shopsDataTable.row(this).data();
                var shopId = data.id;

                // Toggle the visibility of products
                if ($.fn.DataTable.isDataTable('#products-table')) {
                    $('#products-table').DataTable().destroy();
                }

                if ($('#products-container').is(':visible')) {
                    $('#products-container').hide();
                } else {
                    // Initialize DataTable for shop products
                    $('#products-container #shop-name-placeholder').text(data.name + ' Products');
                    $('#products-table').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: "/admin/get-shop-products/" + shopId,
                        columns: [
                            { data: 'id', name: 'id' },
                            { data: 'name', name: 'name' },
                            { data: 'description', name: 'description' },
                            // Add more columns as needed
                        ]
                    });

                    $('#products-container').show();
                }
            });

            // Close button click event
            $('#close-products-btn').on('click', function () {
                $('#products-container').hide();
            });

            function renderActions(data, type, row) {
                var activateBtn = '<button class="btn btn-success btn-activate" data-id="' + row.id + '">Activate</button>';
                var deactivateBtn = '<button class="btn btn-danger btn-deactivate" data-id="' + row.id + '">Deactivate</button>';
                return (row.status == 1) ? deactivateBtn : activateBtn;
            }

            $('#shops-table tbody').on('click', 'button.btn-activate', function () {
                var shopId = $(this).data('id');
                activateOrDeactivateShop(shopId, 'activate');
            });

            $('#shops-table tbody').on('click', 'button.btn-deactivate', function (e) {
                e.stopPropagation();
                var shopId = $(this).data('id');
                activateOrDeactivateShop(shopId, 'deactivate');
            });

            function activateOrDeactivateShop(shopId, action) {
                $.ajax({
                    url: '/admin/shop/' + action + '/' + shopId,
                    type: 'GET',
                    success: function (response) {
                        alert(response.message);
                        shopsDataTable.ajax.reload();
                    },
                    error: function (error) {
                        console.error('Error:', error);
                    }
                });
            }
        });
    </script>
@endsection
