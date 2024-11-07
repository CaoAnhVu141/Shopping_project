@extends('LayOut.admin-dashboard.master_admin')

@section('content')
    <section class="content-header">
        <h1>
            Shipping Methods
            <small>List of shipping methods</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Shipping Methods</a></li>
            <li class="active">List</li>
        </ol>
    </section>

    <section class="content" id="content-area">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><a href="javascript:void(0)" class="btn btn-primary"
                                id="create-shipping-method">Add New</a></h3>
                        <div class="box-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" id="search-key" class="form-control pull-right" placeholder="Search">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default" id="btn-search"><i
                                            class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Name</th>
                                    <th>Cost</th>
                                    <th>Estimated Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="shipping-methods-list">
                                <!-- Data will be dynamically loaded here via Ajax -->
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div id="pagination-links" class="text-right">
                            <!-- Pagination links will be dynamically loaded here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('shopping/data_rest/shipping-methods.js') }}"></script>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        loadShippingMethods(); // Load initial shipping methods

        // Function to load shipping methods with pagination
        function loadShippingMethods(page = 1, searchKey = '') {
            $.ajax({
                url: "{{ route('shipping-methods.index') }}",
                method: "GET",
                data: {
                    page: page,
                    search: searchKey
                },
                dataType: "json",
                success: function(response) {
                    // Update shipping methods list
                    let shippingMethodsHtml = '';
                    response.shippingMethods.data.forEach(function(method, index) {
                        shippingMethodsHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${method.method_name}</td>
                                <td>${method.cost}</td>
                                <td>${method.estimated_time}</td>
                                <td>
                                    <a href="javascript:void(0);" class="btn btn-info btn-sm edit-btn" data-id="${method.id_shipping_method}">Edit</a>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${method.id_shipping_method}">Delete</button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#shipping-methods-list').html(shippingMethodsHtml);

                    // Update pagination links
                    $('#pagination-links').html(response.pagination);
                }
            });
        }

        // Pagination event
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            loadShippingMethods(page);
        });

        // Search event
        $('#btn-search').on('click', function() {
            let searchKey = $('#search-key').val();
            loadShippingMethods(1, searchKey);
        });

        // Edit Shipping Method
        $(document).on('click', '.edit-btn', function() {
            let id = $(this).data('id');
            window.location.href = '/shipping-methods/' + id + '/edit'; // Redirect to edit page
        });

        // Delete Shipping Method
        $(document).on('click', '.delete-btn', function() {
            let id = $(this).data('id');
            if (confirm('Are you sure you want to delete this shipping method?')) {
                $.ajax({
                    url: 'api/shipping-methods/' + id,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Shipping method deleted');
                            loadShippingMethods(); // Reload the list after deletion
                        } else {
                            alert('Failed to delete shipping method');
                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 404) {
                            alert('Shipping method not found');
                        } else if (xhr.status === 500) {
                            alert('Server error occurred while deleting');
                        } else {
                            alert('An error occurred: ' + xhr.statusText);
                        }
                    }
                });
            }
        });
    });
</script>
