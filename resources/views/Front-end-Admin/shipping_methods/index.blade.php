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

                    <!-- Table Section -->
                    <div class="box-body table-responsive no-padding" id="table-section">
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
                                <!-- Data dynamically loaded via API -->
                            </tbody>
                        </table>

                        <!-- Pagination -->
                        <div id="pagination-links" class="text-right">
                            <!-- Pagination links dynamically loaded -->
                        </div>
                    </div>

                    <!-- Modal Thêm Mới -->
                    <div class="modal fade" id="createShippingMethodModal" tabindex="-1"
                        aria-labelledby="createShippingMethodModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createShippingMethodModalLabel">Thêm Phương Thức Vận Chuyển
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Form Thêm Mới -->
                                    <form id="shipping-method-form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Tên phương thức vận chuyển</label>
                                            <input type="text" name="name" id="name" class="form-control"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="cost">Chi phí</label>
                                            <input type="number" name="cost" id="cost" class="form-control"
                                                required>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-2">Thêm mới</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        loadShippingMethods(); // Load initial shipping methods

        $(document).ready(function() {
            // Khi nhấn nút "Add New", mở modal
            $('#create-shipping-method').on('click', function() {
                // Mở modal
                $('#createShippingMethodModal').modal('show');
            });

            // Gửi form khi người dùng submit
            $('#shipping-method-form').on('submit', function(event) {
                event
            .preventDefault(); // Ngăn form gửi dữ liệu thông qua HTTP request thông thường

                // Gửi yêu cầu Ajax để thêm phương thức vận chuyển mới
                $.ajax({
                    url: '{{ route('shipping-methods.store') }}', // Route API
                    method: 'POST',
                    data: $(this).serialize(), // Lấy dữ liệu từ form
                    success: function(response) {
                        if (response.status === 'success') {
                            // Xử lý khi thêm thành công (cập nhật giao diện)
                            var newRow = `
                        <tr>
                            <td>${response.data.name}</td>
                            <td>${response.data.cost}</td>
                            <td>
                                <button class="edit-btn" data-id="${response.data.id}">Edit</button>
                                <button class="delete-btn" data-id="${response.data.id}">Delete</button>
                            </td>
                        </tr>
                    `;
                            // Thêm dòng mới vào bảng (nếu có bảng trong giao diện)
                            $('#shipping-method-table tbody').append(newRow);
                            $('#createShippingMethodModal').modal(
                            'hide'); // Đóng modal sau khi thêm
                            alert(
                            'Phương thức vận chuyển đã được thêm thành công!');
                        }
                    },
                    error: function(error) {
                        alert('Có lỗi xảy ra, vui lòng thử lại.');
                    }
                });
            });
        });
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
                },
                error: function(xhr) {
                    alert('An error occurred while loading shipping methods: ' + xhr.statusText);
                }
            });
        }

        // Search event
        $('#btn-search').on('click', function() {
            let searchKey = $('#search-key').val();
            loadShippingMethods(1, searchKey);
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
