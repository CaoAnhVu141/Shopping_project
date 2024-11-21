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
    // Hàm load phương thức vận chuyển
    function loadShippingMethods(page = 1, searchKey = '') {
        $.ajax({
            url: "{{ route('shipping-methods.index') }}", // Laravel route to fetch data
            method: "GET",
            data: {
                page: page,
                search: searchKey
            },
            dataType: "json",
            success: function(response) {
                // Cập nhật danh sách phương thức vận chuyển
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
                            <form action="{{ route('shipping-method.destroy', $method->id_shipping_method) }}" method="POST" style="display:inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this shipping method?')">
                Delete
            </button>
        </form>
                        </td>
                    </tr>`;
                });

                // Cập nhật nội dung bảng phương thức vận chuyển
                $('#shipping-methods-table tbody').html(shippingMethodsHtml);

                // Cập nhật phân trang
                $('#pagination-links').html(response.pagination); // Phân trang sẽ được hiển thị ở đây
            },
            error: function(xhr) {
                alert('An error occurred while loading shipping methods: ' + xhr.statusText);
            }
        });
    }
    // Xử lý xóa phương thức vận chuyển
    $(document).on('click', '.delete-btn', function() {
        let methodId = $(this).data('id');

        if (!methodId) {
            alert('Shipping method ID is missing.');
            return;
        }

        // Xác nhận hành động xóa
        if (confirm('Are you sure you want to delete this shipping method?')) {
            $.ajax({
                url: `api/shipping-methods/${methodId}`, // Chỉnh sửa URL cho phù hợp
                method: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    alert(response.message);
                    location.reload(); // Tải lại trang sau khi xóa thành công
                },
                error: function(xhr) {
                    let errorMessage = xhr.responseJSON ?
                        xhr.responseJSON.message :
                        'An error occurred while deleting the shipping method';
                    alert(errorMessage);
                },
            });
        }
    });
</script>
