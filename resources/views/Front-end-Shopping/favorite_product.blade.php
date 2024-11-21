@extends('LayOut.shopping.master_shopping')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('shopping/css/favorite.css') }}">

    <div class="container mt-5">
        <h2 class="mb-4">Favorites</h2>

        <div id="favorites-list">
            <!-- Nội dung của danh sách sản phẩm yêu thích sẽ được tải ở đây bằng Ajax -->
        </div>

        <div id="pagination-controls">
            <!-- Nút phân trang sẽ được tạo động tại đây -->
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            const customerId = 2; // Thay thế bằng ID của khách hàng thực tế

            loadFavorites(1); // Load trang đầu tiên khi vào trang

            // Hàm loadFavorites để gọi API và hiển thị dữ liệu
            function loadFavorites(page) {
                $.ajax({
                    url: `/api/favorites/${customerId}`, // Đường dẫn API cho danh sách sản phẩm yêu thích
                    type: 'GET',
                    data: {
                        page: page
                    },
                    success: function(response) {
                        displayFavorites(response.data); // Hiển thị dữ liệu sản phẩm yêu thích
                        setupPagination(response); // Thiết lập phân trang
                    },
                    error: function() {
                        alert("Có lỗi xảy ra, vui lòng thử lại sau.");
                    }
                });
            }

            // Hàm hiển thị sản phẩm yêu thích lên trang
            function displayFavorites(favorites) {
                let html = '';
                favorites.forEach(function(favorite) {
                    html += `
                    <div class="row product-card" data-id="${favorite.id_favorite}">
                        <div class="col-md-2 d-flex align-items-center">
                            <img src="${favorite.product.image_url || 'https://via.placeholder.com/100'}" alt="Product Image" class="img-fluid product-img">
                        </div>
                        <div class="col-md-8">
                            <p class="product-title">${favorite.product.name}</p>
                            <div class="rating mb-2">
                                <span>4</span>
                                <i class="fa fa-star"></i>
                                <span class="text-muted">| 297 đánh giá | 1.1k đã bán</span>
                            </div>
                            <p>
                                <span class="product-old-price">${favorite.product.old_price}đ</span>
                                <span class="product-price">${favorite.product.price}đ</span>
                            </p>
                        </div>
                        <div class="col-md-2 buttons">
                            <button class="btn btn-remove" data-id="${favorite.id_favorite}">Xóa</button>
                            <button class="btn btn-view">Xem</button>
                        </div>
                    </div>`;
                });
                $('#favorites-list').html(html);
            }

            // Hàm thiết lập các nút phân trang
            function setupPagination(response) {
                let paginationHtml = '';
                for (let i = 1; i <= response.last_page; i++) {
                    paginationHtml += `<button class="btn btn-page" data-page="${i}">${i}</button>`;
                }
                $('#pagination-controls').html(paginationHtml);
            }

            // Xử lý khi người dùng nhấn vào nút phân trang
            $(document).on('click', '.btn-page', function() {
                const page = $(this).data('page');
                loadFavorites(page);

            });

            // Sự kiện click cho nút xóa
            $(document).on('click', '.btn-remove', function() {
                const favoriteId = $(this).data('id'); // Lấy ID sản phẩm yêu thích từ thuộc tính data-id
                const customerId = 2; // Thay thế với ID khách hàng thực tế
                const self = $(this); // Lưu đối tượng nút bấm

                // Kiểm tra nếu favoriteId không được định nghĩa
                if (favoriteId === undefined) {
                    alert("Không tìm thấy ID sản phẩm yêu thích.");
                    return; // Dừng hàm nếu không tìm thấy ID
                }

                // Gửi yêu cầu xóa sản phẩm yêu thích
                $.ajax({
                    url: `/api/favorites/${customerId}/${favoriteId}`,
                    type: 'DELETE',
                    success: function(response) {
                        alert("Đã xóa sản phẩm yêu thích.");
                        // Xóa sản phẩm khỏi giao diện ngay lập tức
                        $(`.product-card[data-id="${favoriteId}"]`)
                    .remove(); // Gọi lại DOM element phù hợp và xóa
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseText);
                        alert(`Có lỗi xảy ra: ${xhr.responseText}`);
                    }
                });
            });
        });
    </script>
@endsection

