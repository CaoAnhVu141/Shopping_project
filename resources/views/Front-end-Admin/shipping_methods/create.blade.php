<!-- Form Thêm Mới -->
<form id="shipping-method-form">
    @csrf
    <input type="text" name="name" id="name" placeholder="Tên phương thức vận chuyển" required>
    <input type="number" name="cost" id="cost" placeholder="Chi phí" required>
    <button type="submit">Thêm mới</button>
</form>

<!-- Bảng Phương thức Vận Chuyển -->
<table id="shipping-method-table">
    <thead>
        <tr>
            <th>Tên</th>
            <th>Chi phí</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <!-- Dữ liệu bảng sẽ được cập nhật qua Ajax -->
    </tbody>
</table>

<!-- JavaScript và Ajax -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Gửi form và cập nhật bảng sau khi thêm mới
    $('#shipping-method-form').on('submit', function(event) {
        event.preventDefault(); // Ngăn form gửi thông thường

        // Gửi yêu cầu Ajax để thêm mới phương thức vận chuyển
        $.ajax({
            url: '{{ route('shipping-methods.store') }}', // Đảm bảo sử dụng đúng route
            method: 'POST',
            data: $(this).serialize(), // Lấy dữ liệu từ form
            success: function(response) {
                if (response.status === 'success') {
                    // Thêm phương thức vận chuyển mới vào bảng
                    var newRow = `
                        <tr>
                            <td>${response.data.name}</td>
                            <td>${response.data.cost}</td>
                            <td>
                                <!-- Hành động sửa, xóa có thể thêm vào đây -->
                                <button class="edit-btn" data-id="${response.data.id}">Sửa</button>
                                <button class="delete-btn" data-id="${response.data.id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                    $('#shipping-method-table tbody').append(newRow); // Thêm dòng mới vào bảng
                    alert('Phương thức vận chuyển đã được thêm thành công!');
                }
            },
            error: function(error) {
                alert('Có lỗi xảy ra, vui lòng thử lại.');
            }
        });
    });

    // Hàm tải lại dữ liệu bảng khi trang được tải
    function loadShippingMethods() {
        $.ajax({
            url: '{{ route('shipping-methods.index') }}', // Đảm bảo sử dụng đúng route
            method: 'GET',
            success: function(response) {
                var rows = '';
                response.data.forEach(function(method) {
                    rows += `
                        <tr>
                            <td>${method.name}</td>
                            <td>${method.cost}</td>
                            <td>
                                <button class="edit-btn" data-id="${method.id}">Sửa</button>
                                <button class="delete-btn" data-id="${method.id}">Xóa</button>
                            </td>
                        </tr>
                    `;
                });
                $('#shipping-method-table tbody').html(rows); // Cập nhật bảng với dữ liệu mới
            }
        });
    }

    // Gọi hàm để tải lại bảng khi trang tải
    $(document).ready(function() {
        loadShippingMethods();
    });
</script>
