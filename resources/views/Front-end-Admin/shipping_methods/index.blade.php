@extends('LayOut.admin-dashboard.master_admin')

@section('content')
    <section class="content-header">
        <h1>Shipping Methods</h1>
        <ol class="breadcrumb">
            <li><a href=""><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="">Shipping Methods</a></li>
            <li class="active">Index</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Shipping Methods</h3>
                <a href="{{ route('shipping-method.create') }}" class="btn btn-primary">Add New</a>
                <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="box-body">
                <table id="shipping-methods-table" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Method Name</th>
                            <th>Cost</th>
                            <th>Estimated Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($shippingMethods as $method)
                            <tr>
                                <td>{{ $method->id_shipping_method }}</td>
                                <td>{{ $method->method_name }}</td>
                                <td>{{ $method->cost }}</td>
                                <td>{{ $method->estimated_time }}</td>
                                <td>
                                    <a href="{{ route('shipping-method.edit', $method->id_shipping_method) }}"
                                        class="btn btn-info btn-sm">Edit</a>
                                    <form action="{{ route('shipping-method.destroy', $method->id_shipping_method) }}"
                                        method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this shipping method?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Phân trang -->
                <div id="pagination-links">
                    {{ $shippingMethods->links() }}
                </div>



            </div>
        </div>
    </section>
@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Tìm kiếm
        $('input[name="table_search"]').on('input', function() {
            let searchKey = $(this).val();
            loadShippingMethods(1, searchKey);
        });

        // Xử lý phân trang
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let page = $(this).attr('href').split('page=')[1];
            let searchKey = $('input[name="table_search"]').val();
            loadShippingMethods(page, searchKey);
        });

        // Xử lý xóa phương thức vận chuyển
        $(document).on('click', '.delete-btn', function() {
            let methodId = $(this).data('id');
            if (confirm('Are you sure you want to delete this shipping method?')) {
                $.ajax({
                    url: `/shipping-methods/${methodId}`,
                    method: 'DELETE',
                    success: function(response) {
                        alert(response.message);
                        loadShippingMethods();
                    },
                    error: function(xhr) {
                        alert('An error occurred while deleting the shipping method');
                    }
                });
            }
        });
    });

    // Hàm load phương thức vận chuyển
    function loadShippingMethods(page = 1, searchKey = '') {
        $.ajax({
            url: "{{ route('shipping-methods.index') }}",
            method: "GET",
            data: { page: page, search: searchKey },
            dataType: "json",
            success: function(response) {
                let shippingMethodsHtml = '';
                response.shippingMethods.forEach(function(method) {
                    shippingMethodsHtml += `
                        <tr>
                            <td>${method.id_shipping_method}</td>
                            <td>${method.method_name}</td>
                            <td>${method.cost}</td>
                            <td>${method.estimated_time}</td>
                            <td>
                                <a href="/shipping-method/${method.id_shipping_method}/edit" class="btn btn-info btn-sm">Edit</a>
                                <button data-id="${method.id_shipping_method}" class="btn btn-danger btn-sm delete-btn">Delete</button>
                            </td>
                        </tr>`;
                });
                $('#shipping-methods-table tbody').html(shippingMethodsHtml);
                $('#pagination-links').html(response.pagination);
            },
            error: function(xhr) {
                alert('An error occurred while loading shipping methods: ' + xhr.statusText);
            }
        });
    }
</script>
